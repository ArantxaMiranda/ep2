<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu cuenta - Fashion Style</title>
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
        <h1 class="text-center mb-4">Registro</h1>

        @include('partials.alerts')

        <form action="{{  route('registro.store') }}" method="POST" class="auth-form">
            @csrf
            
            <div class="form-group mb-3 text-start">
                <input type="text" name="name" placeholder="Nombre completo" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="form-group mb-3 text-start">
                <input type="email" name="email" placeholder="Correo Electrónico" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3 text-start">
                <input type="text" name="phone" placeholder="Teléfono" class="form-control" required value="{{ old('phone') }}">
            </div>

            <div class="form-group mb-3 text-start">
                <input type="text" name="direccion" placeholder="Dirección (Opcional)" class="form-control" value="{{ old('direccion') }}">
            </div>

            <div class="form-group mb-3 text-start">
                <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            </div>

            <div class="form-group mb-4 text-start">
                <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control" required>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                    <div class="form-check mb-4 text-start">
                        <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin">
                        <label class="form-check-label text-muted small fw-bold" for="is_admin">Es administrador</label>
                    </div>
                @endif
            @endauth

            <button type="submit" class="auth-btn">Registrarse</button>

        </form>

        <div class="auth-footer mt-4 text-center">
            <p class="text-muted">¿Ya tienes una cuenta? <br>
            <a href="{{ route('acceso') }}" class="text-dark fw-bold text-decoration-none">Inicia sesión aquí</a></p>
        </div>
        
        <div class="mt-3 text-center">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver a la tienda
            </a>
        </div>
    </div>
</body>
</html>
