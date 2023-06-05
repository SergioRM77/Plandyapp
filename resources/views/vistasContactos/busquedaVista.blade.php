<x-layouts.base titulo="Contactos" metaDescription="Contactos de Plandyapp">
    
    <h2 class="uppercase text-2xl text-center ">Busqueda</h2>
    @if (!is_string($busqueda))
        <x-vistas.tiposContactos.busqueda :users="$busqueda" :isContacto="$isContacto" :isBloqueadoPorMi="$isBloqueadoPorMi"/>
    @else
        <h4>{{$busqueda}}</h4>
    @endif
        
    </x-layouts.base>