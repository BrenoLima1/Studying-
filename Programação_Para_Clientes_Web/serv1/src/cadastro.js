window.addEventListener('load', aoCarregar);

function aoCarregar(){
    const enviar = document.getElementById("enviar");
    enviar.addEventListener('click', enviarContato);
}

function enviarContato(ev){
    ev.preventDefault(); //Cancela o submit do formulário
    //Obtendo os dados
    const contato = {
        id : 0,
        nome: document.getElementById('nome').value,
        tel: document.getElementById('tel').value
    };
    //Enviando
    fetch('http://localhost:3000/contatos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(contato)
    })
    .then(resposta =>{
        if(!resposta.ok){
            throw new Error('Erro ao gravar o contato' + resposta.status);
        }
        mostrarMensagem('Salvo com sucesso!');
    })
    .catch(erro => mostrarMensagem(erro));
}

function mostrarMensagem(mensagem){
    document.getElementById('mensagem').innerText = mensagem;
}