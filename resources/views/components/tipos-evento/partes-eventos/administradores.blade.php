<div class="flex border border-black bg-violet-400 pl-2">
    <h4>Administradores:</h4>
    <p>@foreach ($listaParticipantes as $item => $participante)
            @if ($participante->is_admin_principal || $participante->is_admin_secundario)
                <span class="{{$participante->is_admin_principal ? 'bg-lime-400' : 'bg-blue-300'}} rounded-full px-2">@-{{$participante->alias}} </span>
            @endif
        @endforeach</p>
</div>