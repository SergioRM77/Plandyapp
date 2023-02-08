<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlandyApp - {{$titulo ?? ""}}</title>
    <meta content="{{$metaDescription ?? 'Aplicacion de gestion de viajes Plandyapp'}}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
</head>
<body>
    <x-layouts.sidebar/>
    <hr>
    @if (session('status'))
        <div class="status mt-10">
            {{session('status')}}
        </div>
    @endif
    <main class="md:container md:w-3/4 md:my-10 m-3 mt-8">
        {{$slot}}
    </main>
    <x-layouts.footer/>
</body> 
</html>