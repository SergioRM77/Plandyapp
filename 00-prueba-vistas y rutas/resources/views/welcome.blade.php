{{-- Esta forma es con @yield(), en carpeta layout.app --}}
{{-- @extends('layouts.app')

@section('meta-description', "Meta de Pagina HOME")
@section('title', 'Welcome')
    
@section('content')
    <h1>Welcome</h1>
@endsection 

@component('components.layout')
<h1>Welcome</h1>
<p>Esta forma es la alternativa a @ yield(), igual de válida con @ component() pero tenemos que especificarlo
    así ya que esto es un estandar
</p>
@endcomponent  --}}



<x-layouts.app
    title1="Welcome1" 
    metaDescription="Descripción enviada a variable de meta en Página  de inicio"
    sum="2 + 2"
    :result="2 + 2">

    {{-- x-slot es una palabra reservada: se usa para llamar a una variable y dentro de name="nombre_de_variable" 
    todo lo que  pongamos en este x-slot se envía al sitio donde esté definido
    <x-slot name="title">Welcome</x-slot>--}}
    <h1>Welcome</h1>
    <pre>Podemos usar si es de carpeta component:
        @ component 'component . nombre-vista' 
            ...contenido...
        @ endcomponent
    </pre>

    <p>Esta forma es la nueva donde x- automaticamente llama a la carpeta components y lo que 
        sigue después es el nombre del componente, en este caso la vista de layout
    </p>
    <pre>
        < x -nombreVista >
            ...contenido...
        < /x -nombreVista >
    </pre>

</x-layout>