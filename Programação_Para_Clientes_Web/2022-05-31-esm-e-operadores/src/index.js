import { consultarProdutos } from "./consulta-produto.js";
import { listarProdutos } from "./listagem-produto.js";

window.addEventListener( 'load', aoCarregar );

function aoCarregar( ev ) {
    const produtos = consultarProdutos();
    listarProdutos( produtos );
}