<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestión</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        @if (Auth::user()->cargo === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                        @endif
                        @if (Auth::user()->cargo === 'cajero')
                            <li class="nav-item"><a class="nav-link" href="{{ route('gestion.ordenes') }}">Órdenes</a></li>
                        @endif
                        @if (Auth::user()->cargo === 'mesero')
                            <li class="nav-item"><a class="nav-link" href="{{ route('gestion.pedidos') }}">Pedidos</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3">{{ Auth::user()->nombres }} ({{ ucfirst(Auth::user()->cargo) }})</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-danger">Cerrar Sesión</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>    
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS (Opcional, para componentes como modales o tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
