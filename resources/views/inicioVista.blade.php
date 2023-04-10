<x-layouts.base titulo="Inicio" metaDescription="Inicio de Plandyapp">
<h2>Inicio</h2>
<x-vistas.ini-eventos :eventos="$eventos ?? ''" :numEventosFinalizados="$numEventosFinalizados ?? ''"/>
</x-layouts.base>