<?php

namespace acme;
use \Exception;

require_once './usuario.php';
require_once './colecao-usuario.php';
require_once './colecao-exception.php';
require_once './conexao-pdo.php';

Class ColecaoUsuarioEmPDO implements ColecaoUsuario {

    private $pdo;

    public function __construct( \PDO $pdo){
        $this->pdo = $pdo;
    }

    public function todos() {
        try{
            $ps = $this->pdo->prepare('SELECT id, email, minutos FROM usuario');
            $ps->execute();
            $usuarios = [];
            foreach($ps as $registro){
                $usuarios []= new Usuario(
                    $registro[ 'id' ],
                    $registro[ 'email' ],
                    null,
                    $registro[ 'minutos' ]
                );
            }
            return $usuarios;
        }catch( Exception $e){
            throw new ColecaoException ($e->getMessage());
        }
    }

    public function adicionar(Usuario &$u){
        try{
            $ps = $this->pdo->prepare('INSERT INTO usuario ( email, hash_Senha, minutos ) VALUES ( :email, :hashSenha, :minutos )');
            $ps->execute( ['email' => $u->getEmail(), 'hashSenha' => $u->getHashSenha(), 'minutos' => $u->getMinutos()] );

            $id = $this->pdo->lastInsertId();
            $u->setId( $id );

        }catch( Exception $e){
            throw new ColecaoException ($e->getMessage());
        }
    }

    public function depositar($email, $minutos){
        try{
            $ps = $this->pdo->prepare('UPDATE usuario SET minutos = minutos + :minutos WHERE email = :email');
            $ps->execute( ['minutos' => $minutos, 'email' => $email] );

            if ( $ps->rowCount() < 1 ) {
                throw new ColecaoException( 'Usuário não encontrado.' );
            }

        }catch(Exception $e){
            throw new ColecaoException( $e->getMessage() );
        }
    }

    public function retirar($email, $valor){
        try{

            $ps = $this->pdo->prepare('SELECT minutos FROM usuario WHERE email = :email');
            $ps->execute( [ 'email' => $email ] );

            if ( $ps->rowCount() < 1 ) {
                throw new ColecaoException( 'Usuario não encontrado.' );
            }

            $obj = $ps->fetchObject();

            if ( $obj->minutos < $valor ) {
                throw new ColecaoException( 'Você não possui minutos suficientes para serem retirados.' );
            }

            $ps = $this->pdo->prepare(
                'UPDATE usuario SET minutos = minutos - :valor WHERE email = :email' );
            $ps->execute( [
                'valor' => $valor,
                'email' => $email
            ] );

        }catch(Exception $e){
            throw new ColecaoException( $e->getMessage() );
        }
    }

    public function obterComEmail($email){

        try{

            $ps = $this->pdo->prepare('SELECT * FROM usuario WHERE email = :email');
            $ps->execute( [ 'email' => $email ] );

            if($ps->rowCount() < 1){
                return null;
            }

            $registro = $ps->fetchAll();

            return new Usuario (
                $registro[ 'id' ],
                $registro[ 'email' ],
                $registro[ 'minutos' ]
            );
            
        }catch( Exception $e){
            throw new ColecaoException ($e->getMessage());
        }

    }

    public function transferir($emailOrigem, $emailDestino, $minutos){

        try {
            $this->pdo->beginTransaction();
            $this->retirar( $emailOrigem, $minutos );
            $this->depositar( $emailDestino, $minutos );
            $this->pdo->commit();

        } catch ( Exception $e ) {
            $this->pdo->rollBack();
            throw new ColecaoException(
                $e->getMessage());
        }

    }

    public function apagarComEmail( $email ){
        try{

            $comando = "DELETE FROM usuario WHERE email = :email";
            $ps = $this->pdo->prepare($comando);
            $ps->execute([ 'email' => $email ]);

            if ( $ps->rowCount() < 1 ) {
                throw new ColecaoException( 'Usuario não encontrado.' );
            }
        } catch ( Exception $e ) {
            throw new ColecaoException(
                $e->getMessage(), $e->getCode(), $e );
        }
    }

}

?>