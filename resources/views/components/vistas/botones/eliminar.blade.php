<form action="{{e(route('contactos.eliminar'))}}" method="post">
    @csrf
    <input type="hidden" name="alias" value="{{$agregado}}">
    <input class="btn hover:bg-amber-600 bg-yellow-400 py-1 p-2 my-2 mx-6" type="submit" value="Eliminar">
</form>