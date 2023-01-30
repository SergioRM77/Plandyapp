<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlandyApp - {{$titulo ?? ""}}</title>
    <meta content="{{$metaDescription ?? 'Aplicacion de gestion de viajes Plandyapp'}}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-layouts.sidebar/>
    <hr>
    @if (session('status'))
        <div class="status">
            {{session('status')}}
        </div>
    @endif
    {{$slot}}
    <hr>
    <x-layouts.footer/>
</body> 
</html>