    <div class="flex items-center border border-black bg-blue-300 pl-2 rounded-md py-1" id="participantes">
        <div id="desplegable-participante" class="triangulo_inf"></div>
        <h4 class="ml-2">PARTICIPANTES </h4>
    </div>
    <div class="border border-black rounded-b-lg p-2 mx-2" id="lista-participantes">        
        @foreach ($listaParticipantes as $item => $participante)
            <a href="{{e(route('contactos.ver', $participante->alias))}}" class="bg-yellow-300 rounded-full px-2">@-{{$participante->alias}} </a>
        @endforeach
        @if ( $evento["is_activo"] && ($isAdmin->is_admin_principal == true || $isAdmin->is_admin_secundario == true))
        <div class="flex">
            <form action="{{e(route('evento.contactos.add'))}}" method="post">
                @csrf
                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                <button class="btn bg-blue-500 hover:bg-blue-700 hover:text-white mt-2 mx-2">Añadir participante</button>
            </form>
            <form action="{{e(route('evento.contactos.ver'))}}" method="post">
                @csrf
                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                <button class="btn bg-green-500 hover:bg-green-700 hover:text-white mt-2">Ver participantes</button>
            </form>
    </div>
        @endif
    </div>