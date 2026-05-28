<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Painel Admin - Sistema de Enquetes</title>
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(135deg, #1e1e2f 0%, #111119 100%);
            color: #ffffff;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-menu {
            padding: 1.5rem 1rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .menu-item.active {
            background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        .menu-item-icon {
            font-size: 1.25rem;
            margin-right: 0.75rem;
            display: inline-block;
            width: 24px;
            text-align: center;
        }

        /* Main Content Wrapper */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s ease;
            padding: 2rem;
        }

        /* Admin Navbar/Header */
        .admin-header {
            background-color: #ffffff;
            padding: 1rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-bottom: 2rem;
        }

        /* Responsive collapse */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -280px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            .toggle-btn {
                display: block !important;
            }
        }

        .toggle-btn {
            display: none;
            cursor: pointer;
            border: none;
            background: none;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar Menu -->
    <div class="sidebar d-flex flex-column justify-content-between" id="sidebar">
        <div>
            <!-- Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-between">
                <a href="{{ route('polls.index') }}" class="text-decoration-none d-flex align-items-center">
                    <span class="fs-3 me-2">📊</span>
                    <span class="fs-5 fw-bold text-white tracking-wide">PollsAdmin</span>
                </a>
                <button class="btn btn-close btn-close-white d-lg-none" onclick="toggleSidebar()"></button>
            </div>

            <!-- Links -->
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="menu-item active">
                    <span class="menu-item-icon">🛡️</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.polls.create') }}" class="menu-item">
                    <span class="menu-item-icon">➕</span>
                    <span>Criar Enquete</span>
                </a>
            </div>
        </div>

        <!-- Footer / User Info -->
        <div class="p-3 border-top border-secondary border-opacity-25 bg-black bg-opacity-25">
            <div class="d-flex align-items-center mb-3">
                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" style="width: 40px; height: 40px;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <h6 class="text-white mb-0 text-truncate" style="font-size: 0.9rem;">{{ auth()->user()->name }}</h6>
                    <small class="text-muted" style="font-size: 0.75rem;">Administrador</small>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-3">
                    Sair do Painel
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Top Navbar for Mobile/Header tools -->
        <div class="admin-header d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button class="toggle-btn me-3" onclick="toggleSidebar()">
                    ☰
                </button>
                <h5 class="m-0 fw-bold text-dark d-none d-sm-inline-block">Controle de Moderação</h5>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">
                    Painel Protegido 🔒
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show rounded-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dynamic Content -->
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>
