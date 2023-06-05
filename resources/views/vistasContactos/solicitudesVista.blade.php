<x-layouts.base titulo="Contactos" metaDescription="Contactos de Plandyapp">
    
    <h2 class="uppercase text-2xl text-center ">Contactos</h2>
    <x-vistas.tiposContactos.solicitudes :solicitudes="$solicitudes" :agregadorID="$agregadorID ?? ''"/>
    </x-layouts.base>