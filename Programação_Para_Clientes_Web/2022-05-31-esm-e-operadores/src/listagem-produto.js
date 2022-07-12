export function listarProdutos( produtos ) {
    const tbody = document.querySelector( 'tbody' );
    for ( const p of produtos ) {
        const linha = criarLinha( p );
        tbody.appendChild( linha );
    }
}


function criarLinha( produto ) {
    const [ celId, celDescricao, celPreco ] = [
        document.createElement( 'td' ),
        document.createElement( 'td' ),
        document.createElement( 'td' ),
    ];
    celId.innerText = produto.id;
    celDescricao.innerText = produto.descricao;
    celPreco.innerText = produto.preco;
    const linha = document.createElement( 'tr' );
    linha.appendChild( celId );
    linha.appendChild( celDescricao );
    linha.appendChild( celPreco );
    return linha;
}