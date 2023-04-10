<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">

    <h2>Editar Evento Sin Presupuesto</h2>
    <x-tipos-evento.formulario-evento :evento="$evento ?? null" :gastos="$gastos ?? null" :tipo="null"/>
</x-layouts.base>