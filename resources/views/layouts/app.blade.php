<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sistema de enquetes</title>
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4 shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="{{ route('polls.index') }}">
                <span class="fs-4 me-2">📊</span> Enquetes
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
                @guest
                <a class="btn btn-outline-primary btn-sm px-3 rounded-pill" href="{{ route('login') }}">Painel Admin</a>
                @endguest

                @auth
                @if(auth()->user()->isAdmin())
                <a class="btn btn-outline-dark btn-sm px-3 rounded-pill fw-medium" href="{{ route('admin.dashboard') }}">
                    Painel Admin 🛡️
                </a>
                @endif
                <span class="text-muted fs-7">Olá, <strong>{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-link text-danger text-decoration-none btn-sm p-0">
                        Sair
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>

</html>