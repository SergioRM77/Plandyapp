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
            @endif
            
        </x-vistas.tiposContactos.infoContacto>
    @endforeach
@else
    {{$users}}
@endif
