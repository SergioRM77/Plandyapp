<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
</head>
<body>
    <h1>Solicitud de cambio de contraseña</h1>
    <p>En caso de solicitar un cámbio de contraseña rellene el formulario y envíe los datos solicitados
    </p>
    <form action="{{route('mostrar.correo')}}" method="post">
        @csrf
        <label for="">Correo electrónico: 
        <input type="text" name="correo" required></label>
        <label for="">Nombre de usuario (Alias): 
        <input type="text" name="alias" required></label>
        <label for="">Código de verificación: 
        <input type="text" name="codigo" required></label>
        <button>Pulsar aquí para recibir correo con nueva contraseña</button>
    </form>
</body>
</html>