<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Pagina de Login hacia Plandyapp">
    <title>PlandyApp - Registrarse</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-blue-100">
    <header class="fixed w-full h-10 bg-gradient-to-r from-blue-700 to-blue-500 mt-auto top-0">
    </header>
    <div class="bg-fondo-inicio bg-no-repeat bg-blue-100 bg-cover">
        <main class="grid  grid-cols-1 md:grid-cols-3 content-center pt-24">
            <h1 class="grid md:col-start-2">Bienvenido a PlandyApp</h1>
            <p class="grid md:col-start-2">Plataforma de gestion de gastos para viajes, eventos y actividades en grupo</p>
            <h2 class="grid md:col-start-2">Registrarse:</h2>
            
            <div class="grid bg-blue-300 md:col-start-2 border-2 rounded-md border-blue-500  p-4 sm:w-full">
                <p class="grid">Todos los campos con * son obligatorios</p>
                <form  action="{{route('registrarse')}}" method="POST">
                    @csrf
                    <div class="grid content-center">
                        <div class="grid grid-row-3">
                            <label for="foto">Foto:</label>
                            <img class="rounded-full w-10 h-10" src="https://w7.pngwing.com/pngs/11/510/png-transparent-computer-icons-colorado-state-university-user-profile-miscellaneous-service-logo.png" alt="foto perfil">
                            <input class=" my-1" type="file" name="foto">
                        </div>
                        <div class="grid grid-row-2">
                            <label for="nombre_completo">* Nombre completo:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="nombre_completo" value="{{old('nombre_completo')}}" >@error('nombre_completo') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="alias">* Alias:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="alias" value="{{old("alias")}}" >@error('alias') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="telefono">Teléfono:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="telefono" value="{{old('telefono')}}">@error('telefono') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="direccion">Direccion:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="direccion" value="{{old('direccion')}}">@error('direccion') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="localidad">*Localidad:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="localidad" value="{{old('localidad')}}" >@error('localidad') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="codigo_postal">Código Postal:</label>
                            <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" name="codigo_postal" value="{{old('codigo_postal')}}">@error('codigo_postal') <span> {{$message}}</span> @enderror
                        </div>
                        <div class="grid grid-row-2">
                            <label for="intereses">Intereses:</label><br>
                            <textarea class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="text" rows="3" name="intereses" placeholder="#montaña, #playa, #concierto-rock...">{{old('intereses')}}</textarea>@error('intereses') <span> {{$message}}</span> @enderror
                        </div>
                    </div>

                    <div class="grid md:col-start-2 border-2 border-black rounded-md bg-slate-400 p-4 sm:w-full">
                        <label for="password">* Contraseña:</label>
                        <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="password" name="password" >@error('password') <span> {{$message}}</span> @enderror
                        <label for="confirm-password">* Confirmar contraseña:</label>
                        <input class="w-3/4 lg:w-3/4 sm:w-full border border-blue-500 rounded-md my-1" type="password" name="confirm-password" >@error('same') <span> {{$message}}</span> @enderror
                    </div>
                    <div class="flex md:justify-between mt-2">
                        <a class="btn bg-blue-500 hover:bg-blue-700 hover:text-white w-2/5" href="{{e(route('login'))}}">Login</a>
                        <button class="btn bg-green-500 hover:bg-green-700 hover:text-white w-2/5" type="submit">Registrarse</button>
                    </div>

                </form>
                
            </div>
        </main>
    </div>
</body>
</html>