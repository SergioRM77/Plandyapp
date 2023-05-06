<x-layouts.base titulo="Mensajeria" metaDescription="Mensajes de Plandyapp">

<h2>Mensajería</h2>

<x-vistas.mensajeria-comp :chatPrivados="$usuariosChatPrivados" :eventosChat="$eventosChat"/>
</x-layouts.base>