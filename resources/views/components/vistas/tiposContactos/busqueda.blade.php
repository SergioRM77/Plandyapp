@if (!is_string($users))
    @foreach ($users as $user)
        <x-vistas.tiposContactos.infoContacto :user="$user" :isContacto="$isContacto" :isBloqueadoPorMi="$isBloqueadoPorMi">
            @if ($user->id != session('id'))
                @if ($isBloqueadoPorMi == true)
                <x-vistas.botones.desbloquear :desbloquear="$user->alias"/>
                @else
                    <x-vistas.botones.bloquear :bloquear="$user->alias"/>
                @endif
                
                @if ($isContacto == true)
                    <x-vistas.botones.eliminar :agregado="$user->alias"/>
                @else
                    <x-vistas.botones.agregar :agregado="$user->alias"/>
                @endif

                <a class="border border-black rounded-md bg-red-500 py-1 px-2 my-2 text-white" href="{{e(route('chatreporte'))}}">Reportar</a>

            @endif
            
        </x-vistas.tiposContactos.infoContacto>
    @endforeach
@else
    {{$users}}
@endif
