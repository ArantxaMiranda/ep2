<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Fashion Style</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/078a60e29c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-container d-flex align-items-center justify-content-center">
    <div class="auth-card">
        <div class="logo-auth mb-4 text-center">
            <i class="fa-solid fa-shirt"></i>
        </div>
        <h1 class="text-center mb-4">Iniciar Sesión</h1>

        @include('partials.alerts')
        
        <form action="{{ route('acceso.store') }}" method="POST" class="auth-form">
            @csrf
            <div class="form-group mb-3">
                <input type="email" name="email" id="email" placeholder="Correo Electrónico" class="form-control" required>
            </div>
            
            <div class="form-group mb-4">
                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control" required>
            </div>

            <button type="submit" class="auth-btn">Ingresar</button>
        </form>

        <div class="auth-footer mt-4 text-center">
            <p class="text-muted">¿No tienes una cuenta? <br>
            <a href="{{ route('registro') }}" class="text-dark fw-bold text-decoration-none">Regístrate aquí</a></p>
        </div>
        
        <div class="mt-3 text-center">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver a la tienda
            </a>
        </div>
    </div>
</body>
</html>
