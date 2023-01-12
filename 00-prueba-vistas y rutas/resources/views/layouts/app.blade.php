<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi proyecto - @yield('title')</title>
    <meta name="description" content="@yield('meta-description', 'Descripcion por defecto de pagina')">
</head>
<body>
    @include('partials.navigation')

    @yield('content')
</body>
</html>