<?php
    function gerarConexaoPDO(){

        $pdo = null;

        try {
            $pdo = new PDO( 'mysql:dbname=acme;host=localhost', 'root', '', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );
        } catch (PDOException $e) {
            die( $e->getMessage() );
        }

        return $pdo;

    }
?>