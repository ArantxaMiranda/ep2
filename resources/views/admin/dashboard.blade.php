<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Fashion Style</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    @extends('layouts.app')
    @section('content')
        <div class="container py-5">
            <main class="admin-content shadow-sm p-4 bg-white rounded">
                @include('partials.alerts')
                
                <header class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-3">
                    <h1 class="fw-bold">PANEL DE ADMINISTRADOR</h1>
                    <div class="d-flex gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-house"></i> Volver a la Tienda
                        </a>
                        <form action="{{ route('cerrar') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</button>
                        </form>
                    </div>
                </header>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <a href="{{ route('consultarusuarios') }}" class="text-decoration-none">
                            <div class="admin-stat-card bg-primary text-white p-5 rounded-4 text-center transition-hover">
                                <i class="fa-solid fa-users fa-4x mb-3"></i>
                                <h2 class="fw-bold">Usuarios</h2>
                                <p class="mb-0 fs-5">Gestiona los clientes</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('consultarcompras') }}" class="text-decoration-none">
                            <div class="admin-stat-card bg-success text-white p-5 rounded-4 text-center transition-hover">
                                <i class="fa-solid fa-bag-shopping fa-4x mb-3"></i>
                                <h2 class="fw-bold">Compras</h2>
                                <p class="mb-0 fs-5">Historial de ventas</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('consultarproductos') }}" class="text-decoration-none">
                            <div class="admin-stat-card bg-dark text-white p-5 rounded-4 text-center transition-hover">
                                <i class="fa-solid fa-shirt fa-4x mb-3"></i>
                                <h2 class="fw-bold">Productos</h2>
                                <p class="mb-0 fs-5">Control de inventario</p>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    @endsection
</body>
</html>
