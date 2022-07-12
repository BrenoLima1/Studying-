( function( app ) {

    function Telefone( ddd, numero ) {
        this.ddd = ddd;
        this.numero = numero;

        this.conteudo = function() {
            return '(' + this.ddd + ') ' + this.numero;
        };
    }

    app.Telefone = Telefone;

} )( app );