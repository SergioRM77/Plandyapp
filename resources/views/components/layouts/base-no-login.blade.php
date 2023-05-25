<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Pagina de Login hacia Plandyapp">
    <title>PlandyApp - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <header class="fixed w-full flex items-center justify-between h-10 z-10 bg-gradient-to-r from-blue-700 to-blue-500">
        <img src="{{asset('images/logo_prueba5.png')}}" alt="" class="h-10">
    </header>
    <div class="bg-fondo-inicio bg-no-repeat bg-blue-100 bg-cover">
        {{$slot}}
    </div>

</body>
</html>