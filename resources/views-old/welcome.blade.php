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
        {{-- <x-tabla color="yellow" contenido="d"/>
        <x-tabla color="yellow" contenido=""/>
        <x-tabla />
        <x-tabla color="brown" contenido="7"/>
        <x-tabla color="brown" contenido="7sdf"/> --}}

        <x-tabla color="red" contenido="">
            Esto es informacion pasada de la "hucha" a la 
            "moneda" se guarda en variable $slot
        </x-tabla>
{{-- 
        <x-tabla2  tiempo="soleado" meme="hola que tal">
            Esto es $slot y está ocupado por este texto, podemos tener más de 1 slot
            pero hay que darles nombres
            <x-slot name="titulo">
                "titulo"-> ESto es un slot de nombre que pasa de la "hucha" a la "moneda";
            </x-slot>
            <x-slot name="subtitulo">
                "subtitulo"-> Como estamos usando más de un slot, debemos poner nombres
            </x-slot>
        </x-tabla2>

        <x-tabla2/> --}}

        <h3>Pasar dados directamente de código php</h3>
        @php
            $slot_ini="Imaginemos que esto viene de una base de datos";
            $titulo="Titulo de una base de datos";
            $subtitulo="Subtitulo de una base de datos";
            $numUno=5;
            $numDos=7;
        @endphp
        <x-tabla2 :titulo="$titulo" :subtitulo="$subtitulo" :numUno="$numUno" 
        :numDos="$numDos" tiempo="soleado" meme="hola que tal">
            {{$slot_ini}}
        </x-tabla2>
        <hr>
        <x-datos :user="$user ?? ''"/>


    </div>
</body>
</html>