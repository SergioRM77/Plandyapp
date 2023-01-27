<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Pagina de Login hacia Plandyapp">
    <title>PlandyApp - Registrarse</title>
</head>
<body>
    <h1>Bienvenido a PlandyApp</h1>
    @if (session('status'))
        <div class="status">
            {{session('status')}}
        </div>
    @endif
    <p>Plataforma de gestion de gastos para viajes, eventos y actividades en grupo</p>
    <h2>Registrarse:</h2>
    <p>Todos los campos con * son obligatorios</p>

    <form action="{{route('registrarse')}}" method="POST">
        @csrf
    <label for="foto">Foto</label>
    <img src="" alt="foto perfil"><br>
    <input type="file" name="foto" ><br>
    <label for="nombre_completo">* Nombre completo:</label>
    <input type="text" name="nombre_completo" value="{{old('nombre_completo')}}" required>@error('nombre_completo') <span> {{$message}}</span> @enderror<br>
    <label for="alias">* Alias:</label>
    <input type="text" name="alias" value="{{old("alias")}}" required>@error('alias') <span> {{$message}}</span> @enderror<br>
    <label for="email">* Email:</label>
    <input type="email" name="email" value="{{old('email')}}" required>@error('email') <span> {{$message}}</span> @enderror<br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="{{old('telefono')}}">@error('telefono') <span> {{$message}}</span> @enderror<br>
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion" value="{{old('direccion')}}">@error('direccion') <span> {{$message}}</span> @enderror<br>
    <label for="localidad">*Localidad:</label>
    <input type="text" name="localidad" value="{{old('localidad')}}" required>@error('localidad') <span> {{$message}}</span> @enderror<br>
    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" value="{{old('codigo_postal')}}">@error('codigo_postal') <span> {{$message}}</span> @enderror<br>
    <label for="intereses">Intereses:</label><br>
    <textarea type="text" rows="10" name="intereses" placeholder="#montaña, #playa, #concierto-rock...">{{old('intereses')}}</textarea>@error('intereses') <span> {{$message}}</span> @enderror<br>
    <label for="password">* Contraseña:</label>
    <input type="password" name="password" required>@error('password') <span> {{$message}}</span> @enderror<br>
    <label for="confirm-password">* Confirmar contraseña:</label>
    <input type="password" name="confirm-password" required>@error('same') <span> {{$message}}</span> @enderror<br>


    <input type="submit" value="Registrarse">
</form>
<a href="{{e(route('login'))}}">Login</a>
</body>
</html>