<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">

    <h2>Crear Evento Sin Presupuesto Como Admin Principal</h2>
    {{$tipo}}
    <x-tipos-evento.formulario-evento :evento="null" :gastos="null" :tipo="$tipo ?? null"/>
</x-layouts.base>