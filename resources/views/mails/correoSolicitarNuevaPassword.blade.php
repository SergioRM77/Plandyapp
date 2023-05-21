<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar mensaje</title>
    <style>
        li{
            color: brown;
        }
    </style>
</head>
<body>
    <h1>Correo de PlandyApp</h1>
    <p>Ha solicitado cambiar contraseña porque no se acuerda de la contraseña o nombre de usuario. 
        Siga las instrucciones indicadas abajo para poder cambiar contraseña.
    </p>
    
    <p>Código de verificación de cámbio de contraseña: <span><strong>{{$datos["codigo"]}}</strong></span></p>
    <p>Nombre de usuario (Alias): <span><strong>{{$datos["alias"]}}</strong></span></p>
    <p>Correo electrónico: <span><strong>{{$datos["email"]}}</strong></span></p>
    <hr>
    <p>Actualmente NO se ha realizado ningún cambio, si ha ocurrido un error obvie este mensaje, para continuar
        haga los siguientes pasos.
    </p>
    <ol>
        <li>Primero vuelva a inicio.</li>
        <li>Pinche en solicitar cambio de contraseña.</li>
        <li>Seleccione 2º realizar cambio de contraseña.</li>
        <li>Rellene los datos que se le han proporcionado en el correo.</li>
        <li>Al enviar datos recibirá otro correo con una nueva contraseña con la que acceder.</li>
        <li>Ingrese con la nueva contraseña e ir a ajustes para cambiarla por otra que pueda recordar.</li>
    </ol>

    <a href="{{route('login')}}">Volver a Login de PlandyApp</a>
    
</body>
</html>