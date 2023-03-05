<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">

    <h2>Editar Evento Sin Presupuesto</h2>
    <x-tipos-evento.formulario-evento-sin-presu :evento="$evento ?? null" :gastos="$gastos ?? null"/>
</x-layouts.base>