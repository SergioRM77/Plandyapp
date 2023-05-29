<form action="{{e(route('contactos.aceptar'))}}" method="post">
    @csrf
    <input type="hidden" name="alias" value="{{$agregado}}">
    <input class="btn bg-green-500 hover:bg-green-700 hover:text-white py-1 p-2 my-2 mx-6" type="submit" value="Aceptar">
</form>