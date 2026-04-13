<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Panel de Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/078a60e29c.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-dark text-white p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h4 mb-0 text-uppercase"><i class="fa-solid fa-pen-to-square me-2"></i>Editar: {{ $producto->nombre }}</h2>
                            <a href="{{ route('consultarproductos') }}" class="btn btn-outline-light btn-sm">
                                <i class="fa-solid fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.productos.update', $producto) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-bold">Descripción</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="precio" class="form-label fw-bold">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                                        <input type="number" id="precio" step="0.01" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label fw-bold">Stock</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-box-open"></i></span>
                                        <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="categoria" class="form-label fw-bold">Categoría</label>
                                    <input type="text" id="categoria" name="categoria" class="form-control" value="{{ old('categoria', $producto->categoria) }}" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="imagen" class="form-label fw-bold">URL de la Imagen</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                                        <input type="text" id="imagen" name="imagen" class="form-control" value="{{ old('imagen', $producto->imagen) }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('consultarproductos') }}" class="btn btn-secondary px-4">Cancelar</a>
                                <button type="submit" class="btn btn-dark px-4">
                                    <i class="fa-solid fa-sync me-2"></i>Actualizar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
