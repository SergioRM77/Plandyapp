<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlandyApp - {{$titulo ?? ""}}</title>
    <meta content="{{$metaDescription ?? 'Aplicacion de gestion de viajes Plandyapp'}}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script>
        function mostrarOcultarElem(nombreID){
            let contenedor = document.getElementById(nombreID)
            if(contenedor.style.display == "" || contenedor.style.display == "block") {
                contenedor.style.display = "none";
            }
            else {
                contenedor.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <x-layouts.sidebar/>
    <hr>
    @if (session('status'))
        <div class="mt-10">
            {{session('status')}}
        </div>
    @endif
    <main class="md:container md:w-3/4 md:my-10 m-3 mt-8">
        {{$slot}}
    </main>
    <x-layouts.footer/>
</body> 
</html>