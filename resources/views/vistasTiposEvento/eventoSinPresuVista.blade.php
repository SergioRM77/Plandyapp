<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">
    <h2>Evento Activo</h2>
    <x-tipos-evento.evento-sin-presupuesto 
        :evento="$evento" :isAdmin="$isAdmin" :gastos="$gastos" :deben="$deben"
        :listaParticipantes="$listaParticipantes" :listapagos="$listapagos"
        :actividades="$actividades" :listaParticipantesActividades="$listaParticipantesActividades"/>
</x-layouts.base>