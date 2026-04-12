<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

        @include('partials.alerts')

        <h1>INICIO DE SESIÓN</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        
        <form action="{{ route('acceso.store') }}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Correo" class="form-control" required>
            <br>
            <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
            <br>

            <button type="submit" class="btn btn-success">Enviar</button>

        </form>

    @endsection

</body>
</html>
