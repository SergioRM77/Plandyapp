<x-layouts.base titulo="Evento" metaDescription="Evento sin presupuesto Plandyapp">
    <h2>{{session("is_activo") ? "Evento Activo" : "Evento Finalizado"}}</h2>
    <x-tipos-evento.evento 
        :evento="$evento" :isAdmin="$isAdmin" :gastos="$gastos" :gastospresu="$gastospresu"
        :deben="$deben" :listaParticipantes="$listaParticipantes" :listapagos="$listapagos"
        :actividades="$actividades" :listaParticipantesActividades="$listaParticipantesActividades"/>
</x-layouts.base>