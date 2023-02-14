<x-layouts.base titulo="Contactos" metaDescription="Contactos de Plandyapp">
    
    <h2>Contactos</h2>
    <x-vistas.tiposContactos.solicitudes :solicitudes="$solicitudes" :agregadorID="$agregadorID ?? ''"/>
    </x-layouts.base>