<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">

    <h2>Mis contactos para Añadir a evento</h2>
    <div class="border border-black bg-lime-50 p-3">
        @foreach ($contactos as $item => $contacto)
            <form action="{{e(route("evento.contactos.add"))}}" method="post">
                @csrf
                <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                <input type="hidden" name="user_id" value="{{$contacto->id}}">
            <label>Nombre de Contacto: <span class="bg-yellow-300 rounded-full px-2">@-{{$contacto->alias}}</span></label>
            <button class="border border-black rounded-md bg-blue-500 py-1 p-2 my-2 mx-2">Añadir a evento</button>
            </form>
        @endforeach
    </div>
    
    

</x-layouts.base>