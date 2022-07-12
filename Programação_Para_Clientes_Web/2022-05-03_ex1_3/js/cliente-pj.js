( function( app ) {

    function ClientePJ( nome, telefone, cnpj ) {
        app.Cliente.call( this, nome, telefone );

        this.cnpj = cnpj;
    }
    // Clona o protótipo da classe pai
    ClientePJ.prototype = Object.create( app.Cliente.prototype );
    // Reaponta o construtor
    ClientePJ.prototype.constructor = ClientePJ.constructor;

    app.ClientePJ = ClientePJ;

} )( app );