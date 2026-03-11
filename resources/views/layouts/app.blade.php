<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap class -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/078a60e29c.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Contenedor principal de todas las páginas -->
    <div class="container p-5 my-5 border">
        @yield('content')
    </div>
</body>
</html>