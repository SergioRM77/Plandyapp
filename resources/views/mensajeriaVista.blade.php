<x-layouts.base titulo="Mensajeria" metaDescription="Mensajes de Plandyapp">

<h2 class="uppercase text-2xl text-center ">Mensajería</h2>

<x-vistas.mensajeria-comp :chatPrivados="$usuariosChatPrivados" :eventosChat="$eventosChat"/>
</x-layouts.base>