<div class="flex border border-black bg-blue-300 pl-2 rounded-md py-1 mb-2 shadow-lg">
    <h4>ADMINISTRADORES: </h4>
    <p>@foreach ($listaParticipantes as $item => $participante)
            @if ($participante->is_admin_principal || $participante->is_admin_secundario)
                <span class="{{$participante->is_admin_principal ? 'bg-lime-400 font-bold' : 'bg-lime-300'}} rounded-full px-2">@-{{$participante->alias}} </span>
            @endif
        @endforeach</p>
</div>