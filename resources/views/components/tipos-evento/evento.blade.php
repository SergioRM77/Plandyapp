<article>
    <x-tipos-evento.partes-eventos.descripcion :evento="$evento" :isAdmin="$isAdmin"/>
    


    <x-tipos-evento.partes-eventos.participantes :evento="$evento" :listaParticipantes="$listaParticipantes" :isAdmin="$isAdmin"/>
    <x-tipos-evento.partes-eventos.administradores :evento="$evento" :listaParticipantes="$listaParticipantes" :isAdmin="$isAdmin"/>

    <div>
        <h4 class="flex border border-black bg-violet-400 pl-2">DESGLOSE DE GASTOS:</h4>
        <x-tipos-evento.partes-eventos.presupuesto-gastos :evento="$evento" :gastospresu="$gastospresu" :isAdmin="$isAdmin"/>
        <x-tipos-evento.partes-eventos.gastos :evento="$evento" :gastos="$gastos" :isAdmin="$isAdmin"/>
    </div>

    <x-tipos-evento.partes-eventos.actividades :evento="$evento" :actividades="$actividades" :listaParticipantesActividades="$listaParticipantesActividades" :isAdmin="$isAdmin"/>

    <x-tipos-evento.partes-eventos.estado-cuentas :evento="$evento" :listapagos="$listapagos" :deben="$deben" :isAdmin="$isAdmin"/>


</article>

@if (session("is_activo") && $isAdmin->is_admin_principal)
    <form class="grid justify-items-center" action="{{e(route('evento.finalizar'))}}" method="get">
        <button class="border-black w-2/5 btn py-2 px-4 bg-red-600 text-white font-semibold shadow-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" >Finalizar Evento</button>
    </form>
@endif
@if (!session("is_activo"))
    <form class="grid justify-items-center" action="{{e(route('evento.eliminar'))}}" method="get">
        <button class="border-black w-2/5 btn py-2 px-4 bg-red-600 text-white font-semibold shadow-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" >Borrar Evento para mi</button>
    </form>
@endif
<article class="my-10">
    <h4 class="border border-black text-center bg-green-500 text-xl">Has entregado: {{session('pagado')}}€/{{session('mediaPagos')}}€</h4>
    <h4 class="border border-black text-center bg-green-800 text-neutral-100 text-xl">Pago total del Evento: {{session('total')}}€</h4>
</article>

{{-- <label for="my-modal-4" class="btn ml-44">Actualizar Evento</label>
            
    <input type="checkbox" id="my-modal-4" class="modal-toggle" />
    <label for="my-modal-4" class="modal cursor-pointer">
      <label class="modal-box relative bg-amber-400" for="">
            <p>Pegar aqui el formulario, hay que corregir el width por defecto</p>
        </label>
    </label>  --}}