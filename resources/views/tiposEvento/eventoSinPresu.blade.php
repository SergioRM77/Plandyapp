<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">

    <h2>Evento Activo</h2>
    <x-tipos-evento.evento-sin-presupuesto :evento="$evento ?? null" :isAdmin="$isAdmin"/>
</x-layouts.base>