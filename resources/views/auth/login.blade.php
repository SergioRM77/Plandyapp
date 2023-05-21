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
    <div class="bg-fondo-inicio bg-no-repeat bg-blue-100 bg-cover">
        <main class="grid grid-cols-1 md:grid-cols-3 content-center h-screen">
            
            <h1 class="grid md:col-start-2">Bienvenido a PlandyApp</h1>
            <p class="grid md:col-start-2">Plataforma de gestion de gastos para viajes, eventos y actividades en grupo.
                @if (session('status'))
                            <span class="text-red-500">*{{session('status')}}</span>
                @endif
            </p>
        
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
                    
                    <div class="flex md:justify-between">
                        <a class="btn bg-blue-500 hover:bg-blue-700 hover:text-white w-2/5" href="{{e(route('registrarse'))}}">Registrate aquí</a>
                        <button class="btn bg-green-500 hover:bg-green-700 hover:text-white w-2/5" type="submit">Entrar</button>
                    </div>
                </form>
                <label for="my-modal-1" class="btn bg-orange-300 hover:bg-orange-700 hover:text-white mt-2">¿Has olvidado contraseña o nombre de usuario?
                </label>
            </div>
        </main>
    </div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-1" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
  <div class="modal-box bg-orange-100 my-3">
    <h3 class="font-bold text-lg">Para recuperar contraseña ingresa tu correo electrónico</h3>
    <p class="py-4">Ingresa el correo electrónico y recibirás un email con los pasos para cambiar contraseña</p>
    <form action="{{route('solicitud.cambio.password')}}" method="post">
        @csrf
        <label for="">Correo electrónico de recuperación: 
            <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="email">
        </label>
        <input type="submit" class="btn bg-green-500 hover:bg-green-700 hover:text-white" value="1º Enviar Petición de cambio">
    </form>
    <div class="modal-action flex justify-between">
        <label for="my-modal-2" class="btn bg-blue-500 hover:bg-blue-700 hover:text-white">2º realizar cambio de contraseña
        </label>
        <label for="my-modal-1" class="btn bg-red-500 hover:bg-red-700 hover:text-white">Cancelar</label>
    </div>
  </div>
</div>

<input type="checkbox" id="my-modal-2" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
  <div class="modal-box bg-orange-200 my-3">
    <h3 class="font-bold text-lg">Has solicitado cambio de contraseña</h3>
    <p class="py-4">Si existe en nuestra aplicación el correo proporcionado recibirá
        un código de verificación, rellena los siguientes campos y recibirás otro con la nueva
        contraseña
    </p>
    <form action="{{route('nueva.password')}}" method="post">
        @csrf
        <label for="">Código de verificación:
            <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="codigo">
        </label>
        <label>Nombre de usuario (Alias):
            <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="alias">
        </label>
        <label for="">Correo electrónico:
            <input class="w-full border border-blue-500 rounded-md my-1" type="email" name="email" id="">
        </label>

    
    <div class="modal-action flex justify-between">
        <button for="my-modal-2" class="btn bg-green-500 hover:bg-green-700 hover:text-white">Enviar datos</button>
    <label for="my-modal-2" class="btn bg-red-500 hover:bg-red-700 hover:text-white">Cancelar</label>
    </form>
    </div>
  </div>
</div>
</body>
</html>