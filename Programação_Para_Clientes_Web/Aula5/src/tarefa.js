class Tarefa {
  _descricao = "";
  _duracaoEmHoras = 0;

  constructor(descricao, duracaoEmHoras) {
    this._descricao = descricao;
    this._duracaoEmHoras = duracaoEmHoras;
  }

  get descricao() {
    return this._descricao;
  }

  set descricao(valor) {
    if (!valor) {
      throw new Error("A descrição não pode estar vazia");
    }
    if (valor.length < 3 || valor.length > 50) {
      throw new TarefaError("A descrição deve ter entre 3 e 50 caracteres");
    }

    this._descricao = valor;
  }

  get duracaoEmHoras() {
    return this._duracaoEmHoras;
  }

  set duracaoEmHoras(valor) {
    if (valor < 0) {
      throw new Error("A duração de uma tarefa não pode ser menor que 0");
    }
    this._duracaoEmHoras = valor;
  }
}
