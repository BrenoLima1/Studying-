import { Produto } from "./produto.js";

export function consultarProdutos() {
    return [
        new Produto( 1, 'Água com Gás', 2.00 ),
        new Produto( 2, 'Água sem Gás', 1.50 ),
        new Produto( 3, 'Refrigerante de Cola', 3.50 ),
        new Produto( 4, 'Refrigerante de Guaraná', 3.50 ),
        new Produto( 5, 'Quibe', 4.50 ),
        new Produto( 6, 'Pastel', 4.50 ),
    ];
    
}