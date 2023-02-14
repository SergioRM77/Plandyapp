<form action="{{e(route('contactos.aceptar'))}}" method="post">
    @csrf
    <input type="hidden" name="alias" value="{{$agregado}}">
    <input class="border border-black rounded-md bg-yellow-400 py-1 p-2 my-2 mx-6" type="submit" value="Aceptar">
</form>