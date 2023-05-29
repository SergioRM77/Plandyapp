<article>
    <x-tipos-evento.partes-eventos.descripcion :evento="$evento" :isAdmin="$isAdmin"/>
    


    <x-tipos-evento.partes-eventos.participantes :evento="$evento" :listaParticipantes="$listaParticipantes" :isAdmin="$isAdmin"/>
    <x-tipos-evento.partes-eventos.administradores :evento="$evento" :listaParticipantes="$listaParticipantes" :isAdmin="$isAdmin"/>

    <section>
        <div class="flex items-center border border-black bg-blue-500 pl-2 rounded-md py-1" id="desglose-gastos">
            <div id="desplegable-desglose-gastos" class="triangulo_inf"></div>
            <h4 class="ml-2">DESGLOSE DE GASTOS:</h4>
        </div>
        
        <div id="lista-desglose-gastos">
            <x-tipos-evento.partes-eventos.presupuesto-gastos :evento="$evento" :gastospresu="$gastospresu" :isAdmin="$isAdmin"/>
            <x-tipos-evento.partes-eventos.gastos :evento="$evento" :gastos="$gastos" :isAdmin="$isAdmin"/>
        </div>
     </section>

    <x-tipos-evento.partes-eventos.actividades :evento="$evento" :actividades="$actividades" :listaParticipantesActividades="$listaParticipantesActividades" :isAdmin="$isAdmin"/>

    <x-tipos-evento.partes-eventos.estado-cuentas :evento="$evento" :listapagos="$listapagos" :deben="$deben" :isAdmin="$isAdmin"/>


</article>

@if (session("is_activo") && $isAdmin->is_admin_principal)
<div class="flex justify-center">
<label for="my-modal-6" class="border-black w-2/5 btn py-2 px-4 bg-red-600 text-white font-semibold shadow-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mt-2">Finalizar Evento</label>
</div>
<input type="checkbox" id="my-modal-6" class="modal-toggle" />

<div class="modal">
<div class="modal-box w-11/12 max-w-5xl bg-red-50">
    <h3 class="font-bold text-lg">¡Vas a finalizar evento!</h3>
    <p class="py-4">Si finalizas evento tanto tú como los demás usuarios no podréis modificar y añadir nada. Tampoco tendreis 
        acceso al chat del evento. ¿Estás seguro?</p>
    <div class="modal-action">
        <div class="flex flex-row justify-center my-4 w-full">
            <form  action="{{e(route('evento.finalizar'))}}" method="get">
                <button class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-red-500 hover:bg-red-700 hover:text-white">Finalizar Evento</button>
            </form>
            <label for="my-modal-6" class=" btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500 hover:bg-green-700 hover:text-white hover:border-blue-100">Cancelar</label>
        </div>
    </div>
  </div>
</div>
@endif
@if (!session("is_activo"))
<div class="flex justify-center">
<label for="my-modal-5" class="border-black w-2/5 btn py-2 px-4 bg-red-600 text-white font-semibold shadow-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mt-2">Borrar evento para mi</label>
</div>

<input type="checkbox" id="my-modal-5" class="modal-toggle" />

<div class="modal">
  <div class="modal-box w-11/12 max-w-5xl bg-red-50">
    <h3 class="font-bold text-lg">¡Borrar evento!</h3>
    <p class="py-4">Si borras este evento dejarás de verlo en tus eventos finalizados.¿Estás seguro?</p>
    <div class="modal-action">
        <div class="flex flex-row justify-center my-4 w-full">
            <form  action="{{e(route('evento.eliminar'))}}" method="get">
                <button class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-red-500 hover:bg-red-700 hover:text-white">Borrar Evento para mi</button>
            </form>
            <label for="my-modal-5" class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500 hover:bg-green-700 hover:text-white hover:border-blue-100">Cancelar</label>
        </div>
    </div>
  </div>
</div>
@endif
<article class="my-10">
    <h4 class="border border-black text-center bg-green-500 text-xl rounded-t-lg">Has entregado: {{session('pagado')}}€/{{session('mediaPagos')}}€</h4>
    <h4 class="border border-black text-center bg-green-800 text-neutral-100 text-xl rounded-b-lg">Pago total del Evento: {{session('total')}}€</h4>
</article>

{{-- <label for="my-modal-4" class="btn ml-44">Actualizar Evento</label>
            
    <input type="checkbox" id="my-modal-4" class="modal-toggle" />
    <label for="my-modal-4" class="modal cursor-pointer">
      <label class="modal-box relative bg-amber-400" for="">
            <p>Pegar aqui el formulario, hay que corregir el width por defecto</p>
        </label>
    </label>  --}}
<!-- The button to open modal -->


<!-- Put this part before </body> tag -->
