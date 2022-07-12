<?php

require_once './usuario.php';
require_once './colecao-usuario-em-pdo.php';
require_once './listar.php';

use acme\ColecaoUsuarioEmPDO;
use acme\Usuario;

use function acme\listarUsuarios;

    $pdo = gerarConexaoPDO();

    do{
        echo 'Opções:', PHP_EOL;
        echo <<<FIM
            1) Listar usuários
            2) Criar usuário
            3) Realizar um depósito
            4) Realizar uma retirada
            5) Realizar uma transferencia
            6) Deletar usuário
            0) Para Sair
        FIM, PHP_EOL;

        $opcao = readline( 'Opção desejada: ' );
        $usuario = new ColecaoUsuarioEmPDO( $pdo );

        function acmeHash( $texto ) { 
            return sha1( '_.-=[!AcM3' . $texto . '?]=-' );
        }

        switch($opcao){
            case 0:
                echo 'Obrigado!';
                break;
            case 1:
                echo 'Usuários:', PHP_EOL;
                try {
                    listarUsuarios();
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
            case 2:
                $email = readline( 'Email: ' );
                $hashSenha = acmeHash(readline( 'Senha: ' ));
                $minutos = readline( 'Minutos: ' );

                if( empty($email) || empty($hashSenha) || empty($minutos) ){
                    die('Preencha todos os campos!');
                }

                if( mb_strlen( $email ) < 6 ){
                    die( 'O email deve possuir pelo menos 6 caracteres.' );
                }


                if( $minutos < 0 ){
                    die( 'Os minutos devem ser um inteiro positivo' );
                }

                try {
                    $u = new Usuario( 0, $email, $hashSenha, $minutos );
                    $usuario->adicionar( $u );
                    echo 'Id ', $u->getId(), ' gerado', PHP_EOL;
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
            case 3:
                $email = readline( 'Email: ' );
                $minutos  = readline( 'Minutos: ' );

                if( empty($email) || empty($minutos) ){
                    die('Preencha todos os campos!');
                }

                if( mb_strlen( $email ) < 6 ){
                    die( 'O email deve possuir pelo menos 6 caracteres.' );
                }

                if( mb_substr( '@', 0, 1 ) || mb_substr( '@', mb_strlen( $email ) - 1, 1 ) ){
                    die( 'O arroba não deve estar no início ou fim do email' );
                }

                if( $minutos < 0 ){
                    die( 'Os minutos devem ser um inteiro positivo' );
                }

                try {
                    $usuario->depositar( $email, $minutos );
                    echo 'Depósito efetuado com sucesso!', PHP_EOL;
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
            case 4:
                $email = readline( 'Email: ' );
                $minutos = readline( 'Minutos: ' );

                if( empty($email) || empty($minutos) ){
                    die('Preencha todos os campos!');
                }

                if( mb_strlen( $email ) < 6 ){
                    die( 'O email deve possuir pelo menos 6 caracteres.' );
                }

                if( mb_substr( '@', 0, 1 ) || mb_substr( '@', mb_strlen( $email ) - 1, 1 ) ){
                    die( 'O arroba não deve estar no início ou fim do email' );
                }

                if( $minutos < 0 ){
                    die( 'Os minutos devem ser um inteiro positivo' );
                }

                try {
                    $usuario->retirar( $email, $minutos );
                    echo 'Retirada efetuada com sucesso!', PHP_EOL;
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
            case 5:
                $emailOrigem = readline( 'Email Origem: ' );
                $emailDestino = readline( 'Email Destino: ' );
                $minutos = readline( 'Minutos: ' );

                if( empty($emailOrigem) || empty($emailDestino) || empty($minutos) ){
                    die('Preencha todos os campos!');
                }

                if( mb_strlen( $email ) < 6 ){
                    die( 'O email deve possuir pelo menos 6 caracteres.' );
                }

                if( mb_substr( '@', 0, 1 ) || mb_substr( '@', mb_strlen( $email ) - 1, 1 ) ){
                    die( 'O arroba não deve estar no início ou fim do email' );
                }

                if( $minutos < 0 ){
                    die( 'Os minutos devem ser um inteiro positivo' );
                }

                try {
                    $usuario->transferir( $emailOrigem, $emailDestino, $minutos );
                    echo 'transferencia efetuada com sucesso!', PHP_EOL;
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
            case 6:
                $email = readline( 'Email para deletar: ' );

                if( empty($email)){
                    die('Preencha todos os campos!');
                }

                if( mb_strlen( $email ) < 6 ){
                    die( 'O email deve possuir pelo menos 6 caracteres.' );
                }

                if( mb_substr( '@', 0, 1 ) || mb_substr( '@', mb_strlen( $email ) - 1, 1 ) ){
                    die( 'O arroba não deve estar no início ou fim do email' );
                }

                try {
                    $usuario->apagarComEmail( $email );
                    echo 'Deletado com sucesso!', PHP_EOL;
                } catch ( Exception $e ) {
                    die( $e->getMessage() );
                }
                break;
        }
    }while( $opcao != 0 ); 

?>