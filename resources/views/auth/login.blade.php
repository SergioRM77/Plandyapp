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
    </header>
    
    <main class="grid bg-blue-100 grid-cols-1 md:grid-cols-3 content-center h-screen">
        <h1 class="grid md:col-start-2">Bienvenido a PlandyApp</h1>
        <p class="grid md:col-start-2">Plataforma de gestion de gastos para viajes, eventos y actividades en grupo</p>
        <div class="grid bg-blue-300 md:col-start-2 border-2 rounded-md border-blue-500 p-4 sm:w-full">
            <h2>Login:</h2>
            <form  action="{{route('login')}}" method="POST">
                @csrf
                <div class="grid content-center">
                    <div class="grid grid-row-2">
                        <label for="alias">Nombre de usuario (Alias):</label>
                        <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="alias">@error('alias') <span> {{$message}}</span> @enderror
                        
                    </div>
                    <div class="grid grid-row-2">
                        <label for="password">Contraseña:</label>
                        <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="password" name="password">@error('password') <span> {{$message}}</span> @enderror
                    </div>
                </div>
                
                <div class="grid content-center lg:flex md:flex lg:justify-center md:justify-center">
                    <a class="w-3/4 sm:w-full md:w-full lg:w-1/2 border border-black rounded-md bg-blue-500 py-1 p-2 my-2 mx-2 text-center" href="{{e(route('registrarse'))}}">Registrate aquí</a>
                    <button class="w-3/4 sm:w-full md:w-full lg:w-1/2 border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Entrar</button>
                </div>

            </form>
        </div>
    </main>
    
</body>
</html>