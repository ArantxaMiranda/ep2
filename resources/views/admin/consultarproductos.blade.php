<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Productos</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')
    <div class="container py-5">
        <main class="admin-content shadow-sm p-4 bg-white rounded">
            @include('partials.alerts')
            
            <header class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h1 class="fw-bold">CONSULTA DE PRODUCTOS</h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-house"></i> Tienda
                    </a>
                    <form action="{{ route('admin.productos.importar') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-info text-white">
                            <i class="fa-solid fa-cloud-arrow-down"></i> Importar desde API
                        </button>
                    </form>
                    <a href="{{ route('admin.productos.create') }}" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> Nuevo Producto
                    </a>
                </div>
            </header>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>
                                    @if($producto->imagen)
                                        <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" width="60" class="rounded shadow-sm">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $producto->nombre }}</td>
                                <td>${{ number_format($producto->precio, 2) }}</td>
                                <td><span class="badge bg-secondary">{{ $producto->categoria }}</span></td>
                                <td>{{ $producto->stock }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('admin.productos.edit', $producto) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')" title="Eliminar">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    @endsection
</body>
</html>
