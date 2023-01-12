<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi proyecto - {{$title1 ?? 'Por defecto'}}</title>
    <meta name="description" content="{{$metaDescription ?? 'Descripcion por defecto de pagina'}}">
</head>
<body>
    {{-- @include('partials.navigation') --}}

    <x-layouts.navigation/>
    <pre>{{ $sum ?? "vacio"}} = {{ $result ?? "vacio"}}</pre>
    {{$slot}}

    <?php echo "<h2>Esto es un h2 en codigo  php puro</h2>"?>
    
    <h2>Estas usando otra forma, los layout de la carpeta component</h2>
    <p>De esta forma no es necesario el @-lo-que-sea( ), sino la variable reservada { { $slot } } que es 
        equivalente al yield
    </p>
    {{-- @yield('content') --}}
</body>
</html>