class Tarefa{
    _descricao = '';
    _duracaoEmHoras = 0;

    constructor(descricao, duracaoEmHoras) {
        this.descricao = descricao;
        this.duracaoEmHoras = duracaoEmHoras;
    }

    get descricao() {
        return this._descricao;
    }
    set descricao(valor) {
        if (!valor) {
            throw new Error('A decrição não pode estar vazia.');
        }
        if (valor.length < 3 || valor.length > 50) {
            throw new TarefaError('A descrição deve ter entre 3 e 50 caracteres');
        }

        this._descricao = valor;
    }

    get duracaoEmHoras() {
        return this._duracaoEmHoras;
    }
    set duracaoEmHoras(valor) {
        if (valor < 0) {
            throw new TarefaError('A duração em horas deve ser maior que 0');
        }
        this._duracaoEmHoras = valor;
    }

}