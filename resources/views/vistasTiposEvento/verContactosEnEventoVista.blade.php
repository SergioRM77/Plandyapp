<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">

    <h2>Mis contactos En evento</h2>
    <div class="border border-black bg-lime-50 p-3">
        @if (count($contactos)==0)
            <p>No hay contactos en evento</p>
        @endif
        @foreach ($contactos as $item => $contacto)
            <p class="font-semibold italic">Nombre de Contacto: <span class="bg-yellow-300 rounded-full px-2">
                        @-{{$contacto->alias}}</span></p>
            @if ($contacto->is_admin_principal == false)
                <form action="{{e(route("evento.contactos.eliminar"))}}" method="post">
                    @csrf
                    <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                    <input type="hidden" name="user_id" value="{{$contacto->id}}">
                <button class="border border-black rounded-md bg-red-500 py-1 p-2 my-2 mx-2">Eliminar de evento</button>
                </form>
                @if ($contacto->is_admin_secundario == true)
                    <form action="{{e(route('evento.contactos.deleteAdmin'))}}" method="post">
                        @csrf
                        <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                        <input type="hidden" name="user_id" value="{{$contacto->id}}">
                        <button class="border border-black rounded-md bg-yellow-500 py-1 p-2 my-2 mx-2">Dejar de ser Admin Secundario</button>
                    </form>
                @else
                    <form action="{{e(route('evento.contactos.makeAdmin'))}}" method="post">
                        @csrf
                        <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                        <input type="hidden" name="user_id" value="{{$contacto->id}}">
                        <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2">Hacer usuario Admin Secundario</button>
                    </form>
                @endif
            @else
            <span>Admin Principal</span>
            @endif
            
        @endforeach
    </div>
    

</x-layouts.base>