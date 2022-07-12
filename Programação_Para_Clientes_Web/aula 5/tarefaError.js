class TarefaError extends Error{
    constructor(message){
        super(message);
        this.name = 'TarefaError';
    }
}