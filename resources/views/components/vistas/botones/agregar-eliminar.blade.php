<form action="{{e(route('contacto.agregar'))}}" method="get">
    <input type="hidden" name="alias" value="{{$agregado}}">
    <input class="border border-black rounded-md {{$cambiarColor()}} py-1 p-2 my-2 mx-6" type="submit" value="{{$textAceptarCancelarEliminar($agregado)}}">
</form>
{{$agregador}}{{$agregado}}{{$cambiarColor()}}