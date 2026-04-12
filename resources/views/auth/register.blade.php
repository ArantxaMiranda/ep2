<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

    @include('partials.alerts')

    <h1>REGISTRO DE USUARIO</h1>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</strong> Por favor corrige los siguientes errores:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{  route('registro.store') }}" method="POST">

        @csrf
        
        <input type="text" name="name" placeholder="Nombre" class="form-control" required>
        <br>
        <input type="text" name="email" placeholder="Correo" class="form-control" required>
        <br>
        <input type="text" name="phone" placeholder="Teléfono" class="form-control" required>
        <br>
        <input type="password" name="password" placeholder="Contraseña" class="form-control" required>
        <br>
        <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" class="form-control" required>
        <br>

        <div class="form-check">
            <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin">
            <label class="form-check-label" for="is_admin">Es administrador</label>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>


    </form>

    @endsection
</body>
</html>
