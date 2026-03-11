<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos</title>
</head>
<body>

    @extends('layouts.app')

    @section('content')

    <h1>REGISTRAR PRODUCTO</h1>

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('productos.index') }}">
            <button class="btn btn-secondary mb-3"><i class="fa-solid fa-arrow-left"></i> Regresar a la consulta de productos</button>
        </a>
    </div>
    

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
            <input type="text" name="nombre" placeholder="Nombre del producto" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-dollar-sign"></i></span>
            <input type="number" step="0.01" name="precio" placeholder="Precio del producto" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-align-left"></i></span>
            <input type="text" name="descripcion" placeholder="Descripción del producto" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-palette"></i></span>
            <input type="text" name="color" placeholder="Color del producto" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-image"></i></span>
            <input type="text" name="imagen" placeholder="URL de la imagen" class="form-control" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box"></i></span>
            <input type="number" name="stock" placeholder="Stock del producto" class="form-control" required>
        </div>
        <div >

        </div>
        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
    </form>

    @endsection
</body>
</html>