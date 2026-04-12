<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Style</title>
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
                <a href="#"><i class="fa-solid fa-magnifying-glass me-2"></i> Explorar</a>
                @auth
                    <a href="{{ route('productos.index') }}"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
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
                    <h1>EXPLORA <br> TU ESTILO <br> UNICO</h1>
                    <p>
                        Encuentra las mejores prendas y accesorios <br>
                        para que luzcas increíble en cualquier ocasión.
                    </p>
                    <button class="more-btn">Ver Catálogo</button>
                </div>
                <div class="products">
                    @foreach ($ropa as $producto)
                        <button class="product" onclick="alert('¡Producto añadido al carrito!')">
                            <img src="{{ $producto['images'][0] ?? ''}}" alt="{{ $producto['title'] ?? 'Prenda de ropa' }}">
                            <h4>{{ $producto['title'] ?? 'Sin título' }}</h4>
                            <p>${{ number_format($producto['price'] ?? 0, 2) }}</p>
                        </button>
                    @endforeach
                </div>
            </section>

            <section class="hero">
                <div class="hero-text">
                    <h1>CALZADO <br> Y ACCESORIOS</h1>
                    <p>
                        Explora las últimas tendencias en <br>
                        calzado deportivo y casual exclusivo.
                    </p>
                    <button class="more-btn">Ver Colección</button>
                </div>
                <div class="products">
                    @foreach ($accesorios as $producto)
                        <button class="product" onclick="alert('¡Producto añadido al carrito!')" style="cursor: pointer;">
                            <img src="{{ $producto['images'][0] ?? ''}}" alt="{{ $producto['title'] ?? 'Calzado o accesorio' }}">
                            <h4>{{ $producto['title'] ?? 'Sin título' }}</h4>
                            <p>${{ number_format($producto['price'] ?? 0, 2) }}</p>
                        </button>
                    @endforeach
                </div>
            </section>
        </main>
    </div>
</body>
</html>
