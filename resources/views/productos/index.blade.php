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

    <h1>CONSULTA DE PRODUCTOS</h1>

    <div class="d-flex justify-content-end mb-2">
        @if(auth()->user()->is_admin)

            <a href="{{ route('productos.create') }}">
                <button class="btn btn-success me-3"><i class="fa-solid fa-plus"></i> Registrar nuevo producto</button>
            </a>

        @endif
        
        <form action="{{ route('cerrar') }}" method="POST">
            @csrf
            <button class="btn btn-danger"> Cerrar sesión </button>
        </form>

        <!-- Verificar si la sesión está activa -->
        @if(auth()->user()->is_admin)

            <a href="{{ route('admin-dashboard') }}" class="btn btn-secondary">
                Panel Admin
            </a>

        @endif

    </div>
    <hr>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>DESCRIPCIÓN</th>
                <th>COLOR</th>
                <th>IMAGEN</th>
                <th>STOCK</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>

            <!-- Ciclo para recorrer los datos del modelo -->
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->color }}</td>
                    <td><img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}" width="100"></td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto) }}">
                            <button class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> </button>
                        </a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')"><i class="fa-solid fa-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endsection
</body>
</html>