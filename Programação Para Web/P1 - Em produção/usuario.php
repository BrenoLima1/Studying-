<?php

namespace acme;

class Usuario {

    private $id;
    private $email;
    private $hashSenha;
    private $minutos;

    function __construct( $id = 0, $email = '', $hashSenha = '', $minutos = 0 ){
        $this->setId( $id );
        $this->setEmail( $email);
        $this->setHashSenha( $hashSenha );
        $this->setMinutos($minutos);
    }

    function getId() { 
        return $this->id; 
    }

    function setId( $id ) { 
        $this->id = $id; 
    }
    
    function getEmail() { 
        return $this->email; 
    }

    function setEmail( $email ) {

        if( mb_strlen($email) < 6 ){
            throw new ColecaoException( 'Email deve possuir no mínimo 6 caracteres' );
        }

        if( mb_substr($email, 0, 1) == '@' || substr($email, -1) == '@'){
            throw new ColecaoException( 'O arroba não deve estar no início ou fim do email.' );
        }

        $this->email= $email; 
    }

    function getHashSenha() { 
        return $this->hashSenha; 
    }

    function setHashSenha( $hashSenha ) {
        $this->hashSenha= $hashSenha;
    }

    function getMinutos() { 
        return $this->minutos; 
    }

    function setMinutos( $minutos ) { 

        if($minutos < 0){
            throw new ColecaoException( 'Minutos inválidos!' );
        }

        $this->minutos= $minutos; 
    }

}

?>