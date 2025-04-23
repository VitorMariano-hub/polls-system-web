@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="card-title fw-semibold text-primary mb-4">Criar Nova Enquete</h3>

                <form action="{{ route('polls.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="question" class="form-label">Pergunta</label>
                        <input 
                            type="text" 
                            maxlength="150" 
                            name="question" 
                            id="question" 
                            class="form-control" 
                            placeholder="Ex: Qual sua linguagem favorita?" 
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Opções de resposta</label>
                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="Opção 1" required>
                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="Opção 2" required>
                        <input type="text" name="answers[]" class="form-control mb-2" placeholder="Opção 3" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-success px-4">Criar</button>
                        <a href="{{ route('polls.index') }}" class="btn btn-outline-secondary">← Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
