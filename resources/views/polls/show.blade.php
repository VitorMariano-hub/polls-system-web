@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title fw-semibold mb-4 text-primary d-flex align-items-center gap-2 flex-wrap">
                        {{ $poll->question }}
                        @if($poll->is_verified)
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill fs-6" style="font-size: 0.8rem;">
                                🌟 Verificada
                            </span>
                        @endif
                    </h3>

                    <form action="{{ route('polls.vote') }}" method="POST">
                        @csrf
                        <input type="hidden" name="poll_id" value="{{ $poll->id }}">

                        @foreach($poll->answers as $answer)
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="answer_id" 
                                    value="{{ $answer->id }}" 
                                    id="answer_{{ $answer->id }}" 
                                    required
                                >
                                <label class="form-check-label" for="answer_{{ $answer->id }}">
                                    {{ $answer->answer }} 
                                    <span class="text-muted">({{ $answer->votes }} voto{{ $answer->votes !== 1 ? 's' : '' }})</span>
                                </label>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-success px-4">
                                Votar
                            </button>
                            <a href="{{ route('polls.index') }}" class="btn btn-outline-secondary">← Voltar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
