window.addEventListener('load', aoCarregar);

function aoCarregar(){
    document.getElementById('remover').addEventListener('click', remover)
    fetch('http://localhost:3000/contatos')
    .then(resposta => {
        if(!resposta.ok)
        throw new Error('Erro consultando contatos ' + resposta.status)
        return resposta.json();
    })
    .then(contatos  => desenharContatos(contatos))
    .catch(erro => mostrarMensagem(erro.message));
}

function desenharContatos(contatos){
    const tbody = document.querySelector('tbody');
    for(const c of contatos){
        const tdId = document.createElement('td');
        tdId.innerText = c.id;
        const tdNome = document.createElement('td');
        tdNome.innerText = c.nome;
        const tdTelefone = document.createElement('td');
        tdTelefone.innerText = c.tel;
        //Cria a linha
        const tr = document.createElement('tr');
        tr.append(tdId,tdNome,tdTelefone);
        tr.addEventListener('click', aoClicarNaLinha);
        tbody.appendChild(tr);
    }
}

function aoClicarNaLinha(ev){
    const linhaSelecionada = document.querySelectorAll('tr.selecionado');
    for(const lin of linhaSelecionada){
        lin.classList.remove('selecionado');
    }
    const linha = ev.target.parentNode;
    linha.classList.toggle('selecionado');
}

function mostrarMensagem(mensagem){
    document.getElementById('mensagem').innerText = mensagem;
}

function remover(){
    const linha = document.querySelector('tr.selecionado');
    if(!linha){
        alert('Por favor, selecione');
        return;
    }
    const id = linha.firstChild.innerText;

    fetch(`http://localhost:3000/contatos/${id}`, {method: 'DELETE'})
    .then(resposta => {
        if(!resposta.ok){
            throw new Error('Erro removendo contato ' + resposta.status);
        }
        linha.remove()
    })
    .catch(erro => mostrarMensagem(erro.mensagem));
}