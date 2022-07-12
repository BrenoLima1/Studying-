function Produto( descricao, estoque, preco ) {
    this.descricao = descricao;
    this.estoque = estoque;
    this.preco = preco;

    this.toString = function() {
        return this.descricao + ' ' +
            this.estoque + ' ' +
            this.preco;
    };
}