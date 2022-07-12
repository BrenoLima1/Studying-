<?php
namespace acme;

require_once './conexao-pdo.php';
require_once './colecao-usuario-em-pdo.php';


function listarUsuarios(){

    $pdo = gerarConexaoPDO();
    $usuario = new ColecaoUsuarioEmPDO( $pdo );
    $usuarios = $usuario->todos();

    echo 'Listagem de Contatos: ', PHP_EOL;
    foreach( $usuarios as $u ){
        echo ' ', $u->getId(), ' - ', $u->getEmail(), ' - ', $u->getMinutos(), PHP_EOL;
    }
}

?>