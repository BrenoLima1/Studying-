import contatos from './contatos.js';

window.addEventListener( 'load', () => {

    desenharContatos( contatos );

    document.getElementById( 'pesquisar' )
        .addEventListener( 'click', pesquisar );


    document.querySelector( 'thead tr' )
        .addEventListener( 'click', aoClicarNoTitulo );

} );

const ordemColuna = {
  'nome': true,
  'sobrenome': true,
  'ddd': true,
  'número': true,
};

function compararValores(v1, v2, crescente) {
  if (v1 > v2) return crescente ? 1 : -1;
  if (v1 < v2) return crescente ? -1 : 1;
  return 0;
}

function aoClicarNoTitulo(ev) {
  const coluna = ev.target.innerText.toLowerCase();
  console.log(coluna);

  const comparar = (c1, c2) => {
    switch (coluna) {
      case "nome":
        return compararValores(c1.nome, c2.nome, ordemColuna[coluna]);
      case "sobrenome":
        return compararValores(c1.sobrenome, c2.sobrenome, ordemColuna[coluna]);
      case "ddd":
        return compararValores(c1.tel.ddd, c2.tel.ddd, ordemColuna[coluna]);
      case "número":
        return compararValores(c1.tel.numero, c2.tel.numero, ordemColuna[coluna]);
    }
  };

  const resultado = contatos.sort(comparar);
  desenharContatos(resultado);

  ordemColuna[coluna] = !ordemColuna[coluna];
}

function pesquisar(ev) {
    ev.preventDefault();
    const pesquisa = document.getElementById("pesquisa").value;
  
    const resultado = contatos.filter(
      (e) =>
        e.nome.includes(pesquisa) ||
        e.sobrenome.includes(pesquisa) ||
        e.tel.ddd.includes(pesquisa) ||
        e.tel.numero.includes(pesquisa)
    );
  
    desenharContatos(resultado);
  }

function desenharContatos(contatos) {
    const tbody = document.querySelector('tbody');
    while (tbody.firstChild) {
      tbody.removeChild(tbody.firstChild);
    }
    for (const c of contatos) {
      const linha = criarLinha(c);
      tbody.appendChild(linha);
    }
  }

function criarLinha(contato) {
    const [tdNome, tdSobrenome, tdDDD, tdNumero] = [
      document.createElement("td"),
      document.createElement("td"),
      document.createElement("td"),
      document.createElement("td"),
    ];
  
    tdNome.innerText = contato.nome;
    tdSobrenome.innerText = contato.sobrenome;
    tdDDD.innerText = contato.tel.ddd;
    tdNumero.innerText = contato.tel.numero;
  
    const linha = document.createElement("tr");
    linha.append(tdNome, tdSobrenome, tdDDD, tdNumero);
    return linha;
  }