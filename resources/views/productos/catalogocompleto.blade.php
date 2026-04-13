<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Completo - Fashion Style</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/078a60e29c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="main-container">
        <aside class="sidebar">
            <h2 class="logo"><i class="fa-solid fa-shirt"></i><br>Fashion<br>Style</h2>
            <nav>
                <a href="{{ route('home') }}"><i class="fa-solid fa-house me-2"></i> Inicio</a>
                <a href="{{ auth()->check() ? route('favoritos') : route('acceso') }}"><i class="fa-solid fa-heart me-2"></i> Favoritos</a>
                <a href="{{ auth()->check() ? route('compras') : route('acceso') }}"><i class="fa-solid fa-bag-shopping me-2"></i> Mis Compras</a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin-dashboard') }}"><i class="fa-solid fa-gauge me-2"></i> Dashboard Administrador</a>
                    @endif
                @endauth
            </nav>
            
            @auth
                <form action="{{ route('cerrar') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout" style="background: none; border: none; width: 100%; text-align: left; font-size: 16px;"><i class="fa-solid fa-right-from-bracket me-2"></i> Cerrar sesión</button>
                </form>
            @else
                <a href="{{ route('acceso') }}" class="logout" style="text-decoration: none;"><i class="fa-solid fa-user me-2"></i> Iniciar sesión</a>
            @endauth
        </aside>
        
        <main class="content">
            <header class="topbar">
                <div class="menu-links">
                    <a href="{{ route('catalogo') }}">Catálogo</a>
                    <a href="{{ route('ropa') }}">Ropa</a>
                    <a href="{{ route('calzado') }}">Calzado</a>
                    <a href="{{ auth()->check() ? route('carrito') : route('acceso') }}" class="cart-icon" id="cart-main" style="cursor: pointer; display: inline-block; margin-left: 20px; position: relative; text-decoration: none; color: inherit;">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </header>

            <section class="hero">
                <div class="hero-text">
                    <h1>CATÁLOGO completo</h1>
                    <p>Explora todos nuestros productos disponibles de todas las categorías.</p>
                </div>
                <div class="products">
                    @forelse ($productos as $producto)
                        <div class="product shadow-sm border p-3 rounded-4 bg-white mb-4 d-inline-block text-center" style="width: 250px; margin: 10px; transition: transform 0.3s; position: relative;">
                            <img src="{{ $producto['images'][0] ?? ''}}" alt="{{ $producto['title'] ?? 'Producto' }}" class="img-fluid rounded-4 mb-3" style="height: 150px; object-fit: contain;">
                            <h4 class="h6 fw-bold mb-2">{{ $producto['title'] ?? 'Sin título' }}</h4>
                            <p class="h5 fw-bold text-primary mb-3">${{ number_format($producto['price'] ?? 0, 2) }}</p>
                            
                            <div class="d-flex flex-column gap-2 mt-3">
                                <form action="{{ route('favoritos.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="api_id" value="{{ $producto['id'] }}">
                                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill btn-sm shadow-sm py-2">
                                        <i class="fa-solid fa-heart me-1"></i> Favoritos
                                    </button>
                                </form>
                                
                                <form action="{{ route('carrito.agregar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="api_id" value="{{ $producto['id'] }}">
                                    <div class="input-group input-group-sm mb-2 shadow-sm border rounded-pill overflow-hidden bg-white">
                                        <span class="input-group-text bg-light border-0 text-muted small px-3">Cant.</span>
                                        <input type="number" name="cantidad" value="1" min="1" class="form-control border-0 text-center fw-bold" style="max-width: 60px;">
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 rounded-pill btn-sm shadow-sm py-2">
                                        <i class="fa-solid fa-cart-shopping me-1"></i> Carrito
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>No hay productos disponibles en este momento.</p>
                    @endforelse
                </div>
            </section>
        </main>
    </div>
</body>
</html>
