<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Pagina de Login hacia Plandyapp">
    <title>PlandyApp - Login</title>
</head>
<body>
    <h1>Bienvenido a PlandyApp</h1>
    @if (session('status'))
        <div class="status">
            {{session('status')}}
        </div>
    @endif
    <p>Plataforma de gestion de gastos para viajes, eventos y actividades en grupo</p>
    
    <h2>Login:</h2>
    <form action="{{route('login')}}" method="POST">
        @csrf
        <label for="alias">Nombre de usuario (Alias):</label>
        <input type="text" name="alias">@error('alias') <span> {{$message}}</span> @enderror
        <label for="password">Contraseña:</label>
        <input type="password" name="password">@error('password') <span> {{$message}}</span> @enderror
        <button type="submit">Entrar</button>
    </form>
    <div>
        <form action="{{ route("logout") }}" method="post">
            @csrf

            <input type="submit" value="Cerrar Sesión">
        </form>
    </div>
    <a href="{{e(route('registrarse'))}}">Registrate aquí</a>
</body>
</html>