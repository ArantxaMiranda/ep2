<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Fashion Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/078a60e29c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="main-container">
        <aside class="sidebar">
            <h2 class="logo"><i class="fa-solid fa-shirt"></i><br>Fashion<br>Style</h2>
            <nav>
                <a href="{{ route('home') }}"><i class="fa-solid fa-house me-2"></i> Inicio</a>
                <a href="{{ route('favoritos') }}"><i class="fa-solid fa-heart me-2"></i> Favoritos</a>
                <a href="{{ route('compras') }}"><i class="fa-solid fa-bag-shopping me-2"></i> Mis Compras</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin-dashboard') }}"><i class="fa-solid fa-gauge me-2"></i> Dashboard Administrador</a>
                    @endif
                @endauth
            </nav>
            <form action="{{ route('cerrar') }}" method="POST">
                @csrf
                <button type="submit" class="logout" style="background: none; border: none; width: 100%; text-align: left; font-size: 16px;"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión</button>
            </form>
        </aside>
        <main class="content">
            <header class="topbar">
                <div class="menu-links">
                    <a href="{{ route('catalogo') }}">Catálogo</a>
                    <a href="{{ route('ropa') }}">Ropa</a>
                    <a href="{{ route('calzado') }}">Calzado</a>
                    <a href="{{ auth()->check() ? route('carrito') : route('acceso') }}" class="cart-icon" style="text-decoration: none; color: inherit; position: relative;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </header>
            <section class="hero d-block">
                <div class="hero-text mb-4">
                    <h1>CARRITO DE COMPRAS</h1>
                    <p>Revisa y finaliza la compra de tus artículos seleccionados.</p>
                </div>

                <div class="container-fluid">
                    @include('partials.alerts')
                    
                    @if($detalles->isEmpty())
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="fa-solid fa-cart-shopping fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tu carrito está vacío</h4>
                            <a href="{{ route('home') }}" class="btn btn-dark mt-3 rounded-pill px-4">Ir a la tienda</a>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                                    <div class="table-responsive">
                                        <table class="table align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Cant.</th>
                                                    <th class="text-center">Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detalles as $detalle)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ $detalle->producto->imagen }}" alt="{{ $detalle->producto->nombre }}" width="50" class="rounded me-3">
                                                                <div>
                                                                    <div class="fw-bold text-truncate" style="max-width: 150px;">{{ $detalle->producto->nombre }}</div>
                                                                    <small class="text-muted">{{ $detalle->producto->categoria }}</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">${{ number_format($detalle->precio, 2) }}</td>
                                                        <td class="text-center">{{ $detalle->cantidad }}</td>
                                                        <td class="text-center fw-bold">${{ number_format($detalle->subtotal, 2) }}</td>
                                                        <td class="text-end">
                                                            <form action="{{ route('carrito.eliminar', $detalle->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn text-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="bg-white p-4 rounded-4 shadow-sm">
                                    <h5 class="fw-bold mb-4">Resumen de Compra</h5>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Subtotal</span>
                                        <span>${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Envío</span>
                                        <span>$30.00</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <span class="fw-bold">Total</span>
                                        <span class="fw-bold h5 mb-0 text-primary">${{ number_format($total, 2) }}</span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-1">Dirección de entrega:</small>
                                        <p class="small mb-0">{{ auth()->user()->direccion ?? 'No registrada' }}</p>
                                        @if(!auth()->user()->direccion)
                                            <span class="badge bg-danger">Falta dirección</span>
                                        @endif
                                    </div>

                                    <form action="{{ route('carrito.confirmar') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 shadow-sm fw-bold" {{ !auth()->user()->direccion ? 'disabled' : '' }}>
                                            CONFIRMAR COMPRA
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>
</html>
