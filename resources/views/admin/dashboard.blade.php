@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="h3 fw-bold text-dark mb-1">🛡️ Painel de Administração</h1>
            <p class="text-muted mb-0">Gerencie e verifique as enquetes cadastradas no sistema.</p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <span class="badge bg-dark px-3 py-2 rounded-pill fs-6 shadow-sm">
                Total: {{ $polls->count() }} {{ Str::plural('Enquete', $polls->count()) }}
            </span>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-primary-subtle text-primary p-3 rounded-3 me-3">
                        <span class="fs-3">📊</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Total de Votos</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $polls->sum('answers_count') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-success-subtle text-success p-3 rounded-3 me-3">
                        <span class="fs-3">🌟</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Verificadas</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $polls->where('is_verified', true)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-warning-subtle text-warning p-3 rounded-3 me-3">
                        <span class="fs-3">⏳</span>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small fw-bold text-uppercase tracking-wider">Aguardando Verificação</h6>
                        <h3 class="fw-bold text-dark mb-0">{{ $polls->where('is_verified', false)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold mb-0 text-dark">📋 Enquetes Cadastradas</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table align-middle mb-0 table-hover">
                <thead class="table-light text-uppercase fs-7 fw-semibold text-muted">
                    <tr>
                        <th class="ps-4 py-3" style="width: 45%;">Pergunta / Opções</th>
                        <th class="py-3">Criador</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-center">Votos</th>
                        <th class="py-3 text-centerpe-4" style="width: 200px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($polls as $poll)
                        <tr style="transition: background-color 0.2s ease;">
                            <!-- Pergunta e Opções -->
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark mb-1 fs-6">{{ $poll->question }}</div>
                                <div class="d-flex flex-wrap gap-1 mt-1">
                                    @foreach($poll->answers as $answer)
                                        <span class="badge bg-light text-dark border rounded-pill fs-8">
                                            {{ $answer->answer }} ({{ $answer->votes }})
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            
                            <!-- Criador -->
                            <td class="py-3">
                                <div class="fw-medium text-dark">{{ $poll->user->name ?? 'Anônimo' }}</div>
                                <div class="text-muted fs-8">{{ $poll->created_at->format('d/m/Y H:i') }}</div>
                            </td>

                            <!-- Status -->
                            <td class="py-3 text-center">
                                @if($poll->is_verified)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold">
                                        🌟 Verificada
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-semibold">
                                        ⏳ Pendente
                                    </span>
                                @endif
                            </td>

                            <!-- Total de Votos -->
                            <td class="py-3 text-center fw-bold text-dark fs-6">
                                {{ $poll->answers_count }}
                            </td>

                            <!-- Ações -->
                            <td class="py-3 text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Toggle Verification -->
                                    <form action="{{ route('admin.polls.verify', $poll) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($poll->is_verified)
                                            <button type="submit" class="btn btn-outline-warning btn-sm px-3 rounded-pill fw-medium" title="Desmarcar verificação">
                                                Remover Selo
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill fw-medium text-white shadow-sm" title="Verificar enquete">
                                                Aprovar Selo
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Delete Poll -->
                                    <form action="{{ route('admin.polls.destroy', $poll) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir esta enquete permanentemente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm p-1.5 px-2.5 rounded-pill" title="Excluir enquete">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="fs-1 mb-2">📭</div>
                                <div>Nenhuma enquete cadastrada no sistema.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .fs-7 { font-size: 0.8rem; }
    .fs-8 { font-size: 0.72rem; }
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.12) !important; }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.12) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.12) !important; }
</style>
@endsection
