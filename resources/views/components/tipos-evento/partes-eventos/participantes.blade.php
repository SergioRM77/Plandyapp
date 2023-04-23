<h4 class="border border-black bg-violet-400 pl-2">Participantes</h4>
    <div class="border border-black rounded-b-lg p-2 mx-2">        
        @foreach ($listaParticipantes as $item => $participante)
            <a href="{{e(route('contactos.ver', $alias = $participante->alias))}}" class="bg-yellow-300 rounded-full px-2">@-{{$participante->alias}} </a>
        @endforeach
        @if ( $evento["is_activo"] && ($isAdmin->is_admin_principal == true || $isAdmin->is_admin_secundario == true))
        <div class="flex">
            <form action="{{e(route('evento.contactos.add'))}}" method="post">
                @csrf
                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                <button class="border border-black rounded-md bg-blue-500 py-1 p-2 my-2 mx-2">Añadir participante</button>
            </form>
            <form action="{{e(route('evento.contactos.ver'))}}" method="post">
                @csrf
                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2">Ver participantes</button>
            </form>
    </div>
        @endif
    </div>