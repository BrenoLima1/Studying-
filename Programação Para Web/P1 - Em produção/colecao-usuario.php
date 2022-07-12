<?php

namespace acme;
require_once 'usuario.php';

interface ColecaoUsuario {

    /*** Adiciona um usuário, que recebe um ID ao ser adicionado.
     * * @param Usuario $u Usuário a ser adicionado.
     * * @throws ColecaoException
    */
    function adicionar(Usuario &$u );

    /*** Retorna um array de objetos da classe Usuario com seus hashes sempre vazios.
     * * @returns array of Usuario
     * * @throws ColecaoException
    */

    function todos();
}

?>