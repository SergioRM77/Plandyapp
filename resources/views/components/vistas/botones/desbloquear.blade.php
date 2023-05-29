<form action="{{e(route('contactos.desbloquear'))}}" method="post">
    @csrf
    <input type="hidden" name="alias" value="{{$desbloquear}}">
    <input class="btn bg-red-500 hover:bg-red-700 py-1 p-2 my-2 mx-6" type="submit" value="Desbloquear">
</form>