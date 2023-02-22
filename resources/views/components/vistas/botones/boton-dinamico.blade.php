<form action="{{$ruta}}" method="post">
    @csrf
    <input type="hidden" name="alias" value="{{$valor}}">
    <button class="border border-black rounded-md {{$color}} py-1 p-2 my-2 mx-6" type="submit">{{$textoBoton}}</button>
</form>