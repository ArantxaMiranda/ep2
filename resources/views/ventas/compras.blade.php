<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras - Fashion Style</title>
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
                    <h1>MIS COMPRAS</h1>
                    <p>Consulta el historial y los detalles de cada compra realizada.</p>
                </div>

                <div class="container-fluid">
                    @if($compras->isEmpty())
                        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                            <i class="fa-solid fa-receipt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Aún no has realizado ninguna compra</h4>
                            <a href="{{ route('home') }}" class="btn btn-dark mt-3 rounded-pill px-4">Ir a la tienda</a>
                        </div>
                    @else
                        <div class="compras-list">
                            @foreach($compras as $compra)
                                <div class="card border-0 mb-4 rounded-4 shadow-sm overflow-hidden">
                                    <div class="card-header bg-white py-3 px-4 border-bottom">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-calendar-check text-primary me-2"></i>
                                                <span class="fw-bold">{{ $compra->created_at->format('d/m/Y H:i') }}</span>
                                                <span class="badge bg-light text-dark border ms-3">ID: #{{ $compra->id }}</span>
                                            </div>
                                            <div class="h5 mb-0 text-primary fw-bold">Total: ${{ number_format($compra->total, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-white p-4">
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <p class="mb-1 text-muted small fw-bold text-uppercase">Dirección de Envío:</p>
                                                <p class="mb-0 border-start ps-3 py-1 bg-light rounded small">{{ $compra->direccion }}</p>
                                            </div>
                                            <div class="col-md-6 text-md-end">
                                                <p class="mb-1 text-muted small fw-bold text-uppercase">Resumen de Totales:</p>
                                                <div class="d-inline-block text-start bg-light p-2 rounded min-w-150">
                                                    <div class="d-flex justify-content-between gap-3 small">
                                                        <span>Subtotal:</span> <span>${{ number_format($compra->subtotal, 2) }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between gap-3 small text-muted">
                                                        <span>Envío:</span> <span>$30.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive bg-white rounded-3 border overflow-hidden">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="table-dark small">
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th class="text-center">Cant.</th>
                                                        <th class="text-center">Precio Unit.</th>
                                                        <th class="text-end px-4">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($compra->detalles as $detalle)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="{{ $detalle->producto->imagen }}" alt="{{ $detalle->producto->nombre }}" width="40" class="rounded me-3 border">
                                                                    <div class="small">
                                                                        <div class="fw-bold">{{ $detalle->producto->nombre }}</div>
                                                                        <div class="text-muted text-truncate" style="max-width: 200px;">{{ $detalle->producto->categoria }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center fw-bold">{{ $detalle->cantidad }}</td>
                                                            <td class="text-center">${{ number_format($detalle->precio, 2) }}</td>
                                                            <td class="text-end px-4 fw-bold text-primary">${{ number_format($detalle->subtotal, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>
</body>
</html>
