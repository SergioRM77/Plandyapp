<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar mensaje</title>

</head>
<body>
    <h1>Correo de PlandyApp</h1>
    <p>Aquí se envía la nueva contraseña, por favor ingrese y cámbiela por una nueva lo antes posible</p>
    <p>Nombre de Usuario: <span><strong>{{$datos["alias"]}}</strong></span></p>
    <p>Correo electrónico: <span><strong>{{$datos["email"]}}</strong></span></p>
    <p>contraseña: <span><strong>{{$datos["password"]}}</strong></span></p>
    <a href="{{route('login')}}">Regresar a Login</a>
</body>
</html>