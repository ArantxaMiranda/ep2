<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Ventas</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')
    <div class="container py-5">
        <main class="admin-content shadow-sm p-4 bg-white rounded">
            @include('partials.alerts')
            
            <header class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h1 class="fw-bold">CONSULTA DE VENTAS</h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin-dashboard') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-gauge"></i> Dashboard
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-house"></i> Tienda
                    </a>
                </div>
            </header>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Venta</th>
                            <th>Usuario</th>
                            <th>Dirección</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-end">Envío</th>
                            <th class="text-end px-3">Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td class="fw-bold">#{{ $compra->id }}</td>
                                <td>
                                    <div class="fw-bold">{{ $compra->usuario->name ?? 'Usuario Desconocido' }}</div>
                                    <small class="text-muted">{{ $compra->usuario->email ?? 'N/A' }}</small>
                                </td>
                                <td>{{ $compra->direccion }}</td>
                                <td class="text-end">${{ number_format($compra->subtotal, 2) }}</td>
                                <td class="text-end">$30.00</td>
                                <td class="text-end px-3 fw-bold text-primary">${{ number_format($compra->total, 2) }}</td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <!-- Botón de promociones (Sin acción por ahora) -->
                                        <button type="button" class="btn btn-info btn-sm text-white" title="Enviar Notificación de Compra">
                                            <i class="fa-solid fa-envelope"></i>
                                        </button>

                                        <!-- Botón para eliminar venta -->
                                        <form action="{{ route('admin.compras.destroy', $compra->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta venta? Esto borrará también sus detalles asociados.')" title="Eliminar Venta">
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