<div>
    <p>--Contenido por defeto de plantilla</p>
    <p>{{$slot ?? ""}}</p>
    <p>{{$titulo ?? ""}}</p>
    <p>{{$subtitulo ?? ""}}</p>

    <p>{{$numUno ?? "numero 1"}} * {{$numDos ?? "numero 2"}} = 
        {{$numUno * $numDos ?? "No se puede hacer operaciones"}}</p>
    <p>{{$attributes}}</p>
    <p>{{gettype($attributes)}}</p>
    <p>{{var_dump((array)$attributes)}}</p>

</div>