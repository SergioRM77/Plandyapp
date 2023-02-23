<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">

    <h2>Evento Activo</h2>
    <x-tipos-evento.evento-sin-presupuesto 
        :evento="$evento ?? null" :isAdmin="$isAdmin" 
        :gastos="$gastos ?? null" :pagos="$pagos ?? null"/>
</x-layouts.base>