<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alerta de inicio de sesión</title>
    <style>
        .container{
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .content{
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .btn{
            background: blue;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 7px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Nuevo inicio de sesión :o </h2>
            <p>Se ha detectado nueva actividad en la cuenta</p>

            <a href="{{ route('acceso') }}" class="btn" style="color:white;"> Verificar actividad </a>

            <p style="margin-top:20px;">
                Si no fuiste tú, solicita un cambio de contraseña <br>
                al administrador.
            </p>
        </div>
    </div>
</body>
</html>
