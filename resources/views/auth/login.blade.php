@extends('layouts.app') {{-- Supondo que esse seja o layout que você colou --}}

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <h4 class="mb-4 text-center">Login no sistema</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
