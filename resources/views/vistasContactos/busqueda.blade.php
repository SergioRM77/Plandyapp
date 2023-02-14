<x-layouts.base titulo="Contactos" metaDescription="Contactos de Plandyapp">
    
    <h2>Busqueda</h2>
        <x-vistas.tiposContactos.busqueda :users="$busqueda" :isContacto="$isContacto" :isBloqueadoPorMi="$isBloqueadoPorMi"/>
    </x-layouts.base>