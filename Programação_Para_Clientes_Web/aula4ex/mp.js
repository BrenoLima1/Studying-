class MateriaPrima {
    _descricao = '';
    _estoque = 0;
    constructor( descricao, estoque ) {
        this.descricao = descricao;
        this.estoque = estoque;
    }

    get descricao() { return this._descricao; }
    set descricao( valor ) {
        if ( ! valor || valor.length < 2 ) {
            throw new Error( 'A descrição deve ter pelo menos 2 caracteres.' );
        }
        if ( valor.length > 100 ) {
            throw new Error( 'A descrição deve ter no máximo 100 caracteres.' );
        }
        this._descricao = valor;
    }

    get estoque() { return this._estoque; }
    set estoque( valor ) {
        if ( isNaN( valor ) ) {
            throw new Error( 'O estoque deve ser um número.' );
        }
        const v = Number( valor );
        if ( v < 0 ) {
            throw new Error( 'O estoque deve ser zero ou superior.' );
        }
        this._estoque = v;
    }
}