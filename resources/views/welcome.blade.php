<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOlaaaa</h1>
    <h2>{{$titulo ?? ""}}</h2>
    <div>
        <x-alerta/>
        <x-tabla color="yellow" contenido="d"/>
        <x-tabla color="yellow" contenido=""/>
        <x-tabla />
        <x-tabla color="brown" contenido="7"/>
        <x-tabla color="brown" contenido="7sdf"/>

        <x-tabla>
            Esto es informacion pasada de la "hucha" a la "moneda" se guarda en variable $slot
        </x-tabla>

        <x-tabla2>
            el componente slot está ocupado
            <x-slot name="titulo">
                ESto es un slot de nombre que pasa de la "hucha" a la "moneda";
            </x-slot>
            <x-slot name="subtitulo">
                Como estamos usando más de un slot, debemos poner nombres
            </x-slot>
        </x-tabla2>

        <x-tabla2/>

        <h3>Pasar dados directamente de código php</h3>
        @php
            $slot_ini="Imaginemos que esto viene de una base de datos IMPORTANTE: SI SE USA PHP
            HAY QUE DECLARAR LAS VARIABLES EN app\View\Components\ nombre_de_clase.php";
            $titulo="Titulo de una base de datos";
            $subtitulo="Subtitulo de una base de datos";
        @endphp
        <x-tabla2 :titulo="$titulo" :subtitulo="$subtitulo" tiempo="soleado" meme="meme">
            {{$slot_ini}}
        </x-tabla2>
        <hr>
        <x-datos/>


    </div>
</body>
</html>