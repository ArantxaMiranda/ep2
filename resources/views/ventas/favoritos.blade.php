<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos - Fashion Style</title>
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
                <a href="#"><i class="fa-solid fa-magnifying-glass me-2"></i> Explorar</a>
                @auth
                    <a href="{{ route('productos.index') }}"><i class="fa-solid fa-gauge me-2"></i> Dashboard</a>
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
            <section class="hero">
                <div class="hero-text">
                    <h1>MIS FAVORITOS</h1>
                    <p>Aquí aparecerán las prendas que más te gustan.</p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
