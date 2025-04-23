@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h3 class="card-title fw-semibold mb-4 text-primary">{{ $poll->question }}</h3>

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
