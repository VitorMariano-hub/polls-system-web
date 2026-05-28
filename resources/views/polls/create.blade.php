@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-bottom py-3">
                    <h4 class="card-title fw-bold text-dark mb-0">➕ Criar Nova Enquete</h4>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-4">Insira a pergunta principal e pelo menos duas opções de resposta para os usuários votarem.</p>

                    <form action="{{ route('admin.polls.store') }}" method="POST">
                        @csrf

                        <!-- Pergunta -->
                        <div class="mb-4">
                            <label for="question" class="form-label fw-semibold text-dark">Pergunta da Enquete</label>
                            <input 
                                type="text" 
                                maxlength="150" 
                                name="question" 
                                id="question" 
                                class="form-control form-control-lg rounded-3" 
                                placeholder="Ex: Qual sua linguagem favorita?" 
                                required
                            >
                        </div>

                        <!-- Opções -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Opções de Resposta</label>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" name="answers[]" class="form-control rounded-3" placeholder="Opção 1" required>
                                <input type="text" name="answers[]" class="form-control rounded-3" placeholder="Opção 2" required>
                                <input type="text" name="answers[]" class="form-control rounded-3" placeholder="Opção 3" required>
                            </div>
                        </div>

                        <!-- Ações -->
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <button type="submit" class="btn btn-success px-4 rounded-pill fw-medium shadow-sm">
                                Criar Enquete
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-medium">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
