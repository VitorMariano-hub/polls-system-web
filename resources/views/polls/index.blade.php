@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-semibold">📊 Todas as Enquetes</h2>
    </div>

    @forelse ($polls as $poll)
        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center ">
                    <h5 class="card-title mb-3 d-flex align-items-center gap-2 flex-wrap">
                        {{ $poll->question }}
                        @if($poll->is_verified)
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 0.75rem;">
                                🌟 Verificada
                            </span>
                        @endif
                    </h5>
                    @if (auth()->check())
                        <form action="{{ route('polls.destroy', $poll) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir esta enquete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">Excluir</button>
                        </form>
                    @endif
                </div>
                @foreach ($poll->answers as $answer)
                    <div class="mb-3 mt-4">
                        <div class="d-flex justify-content-between">
                            <span class="fw-medium">{{ $answer->answer }}</span>
                            <small class="text-muted">{{ $answer->votes }} voto(s)</small>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div 
                                class="progress-bar bg-primary" 
                                role="progressbar" 
                                style="width: {{ round($answer->votes_porcent ?? 0, 2) }}%;" 
                                aria-valuenow="{{ round($answer->votes_porcent ?? 0, 2) }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                {{ round($answer->votes_porcent ?? 0, 2) }}%
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('polls.show', $poll) }}" class="btn btn-outline-primary btn-sm">Votar</a>
                    <span class="text-muted">{{ $poll->answers_count ?? $poll->answers->count() }} votos recebidos</span>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Nenhuma enquete cadastrada ainda.</div>
    @endforelse
@endsection
