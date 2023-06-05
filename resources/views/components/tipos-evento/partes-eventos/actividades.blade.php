<div class="flex items-center border border-black bg-sky-400 pl-2 rounded-md p-1 mt-2" id="actividades">
    <div id="desplegable-actividades" class="triangulo_inf"></div>
    <h5 class="ml-2">ACTIVIDADES:</h5>
</div>
<div class="actividades"id="lista-actividades">
    
    <div class="border border-black rounded-b-lg mx-2 px-2 {{
        count($actividades) > 4 ? 'overflow-y-auto h-96 scrollbar-thin scrollbar-thumb-violet-400 scrollbar-thumb-rounded-lg scrollbar-track-rounded-md scrollbar-track-slate-300' : ''
        }}" >
        @if (count($actividades)>0)
            @foreach ($actividades as $item => $actividad)
            <div class="flex items-center ">
                <div class="flex-none border border-black rounded-full p-2 w-1 h-1 
                {{date("Y-m-d H:i") > date("Y-m-d H:i", strtotime($actividad->fecha . $actividad->hora)) ? 'bg-red-600'
                : ' bg-green-600'}}"></div>
                <div class="grid md:grid-rows-1 md:grid-cols-3 shadow-lg grid-rows-2 grid-cols-1 border border-black rounded-md w-full m-2 px-2">
                    <div class="row-span-2 w-full">
                        <p><span class="font-semibold">Nombre de actividad: </span>{{$actividad->nombre_actividad}}</p>
                        <p><span class="font-semibold">Coste individual: </span>{{$actividad->coste}}</p>
                        <p><span class="font-semibold">Participantes: </span>
                            @foreach ($listaParticipantesActividades as $key => $participanteActividad)
                            @if ($participanteActividad->actividad_id == $actividad->id)
                                <span class="bg-yellow-300 rounded-full px-2">@-{{$participanteActividad->alias}} </span>
                            @endif
                            @endforeach
                        </p>
                        <p><span class="font-semibold">Fecha y hora de inicio: </span>{{$actividad->fecha == null ? '--/--/-- --:--': date("d-m-Y H:i", strtotime($actividad->fecha . $actividad->hora))}}</p>
                        <p><span class="font-semibold">Descripcion: </span>{{$actividad->descripcion_actividad}}</p>
                    </div>
                    <div class="row-span-1 md:col-start-3 justify-items-center my-4">
                        @if ($evento["is_activo"] && ($isAdmin->is_admin_principal || $isAdmin->is_admin_secundario))
                            <form action="{{e(route('delete.actividad'))}}" method="post">
                                @csrf
                                <input type="hidden" name="id_actividad" value="{{$actividad->id}}">
                                <input type="hidden" name="nombre_actividad" value="{{$actividad->nombre_actividad}}">
                                <button class="btn bg-red-500 hover:bg-red-600 hover:text-white p-2 my-2 mx-2 lg:w-2/4 w-24" type="submit">Eliminar</button>

                            </form>
                            <form action="{{e(route('editar.actividad'))}}" method="post">
                                @csrf
                                <input type="hidden" name="id_actividad" value="{{$actividad->id}}">
                                <button class="btn bg-green-500 hover:bg-green-600 hover:text-white p-2 my-2 mx-2 lg:w-2/4 w-24"  type="submit">Actualizar</button>
                            </form>
                        @endif
                        
                            
                        @foreach ($listaParticipantesActividades as $key => $participanteActividad)
                            @if ($evento["is_activo"] && $participanteActividad->actividad_id == $actividad->id && $participanteActividad->participante_id == session('id'))
                                <form action="{{e(route('delete.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="btn bg-yellow-500 hover:bg-yellow-600 hover:text-white p-2 my-2 mx-2 lg:w-2/4 w-24" type="submit">Salirse</button>
                                </form>
                                @break
                            @endif
                            @if ($evento["is_activo"] && isset($listaParticipantesActividades[$key+1]) == false && count($listaParticipantesActividades)  == $key+1)
                                <form action="{{e(route('add.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="btn bg-blue-500 hover:bg-blue-600 hover:text-white p-2 my-2 mx-2 lg:w-2/4 w-24" type="submit">Unirse</button>
                                </form>
                            @endif
                            @endforeach
                            {{-- @if ($evento["is_activo"] && count($listaParticipantesActividades) == 0)
                                <form action="{{e(route('add.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-blue-500 my-2 mx-2 w-4/6" type="submit">Unirse a Actividad</button>
                                </form>
                            @endif --}}
                        </div>

                </div>
    </div>
            @endforeach

        @else
            <p>No hay actividades</p>
        @endif

</div>


        @if ($evento["is_activo"] && ($isAdmin->is_admin_principal == true || $isAdmin->is_admin_secundario == true))
        <div class="flex justify-center my-2">
            <label for="my-modal-3" class="border-black w-2/5 btn py-2 px-4 bg-sky-400 text-white font-semibold shadow-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                <lord-icon
                    src="https://cdn.lordicon.com/mecwbjnp.json"
                    trigger="hover">
                </lord-icon>
                Crear Actividad
            </label>
        </div>
    </div>

<input type="checkbox" id="my-modal-3" class="modal-toggle" />
    
<div class="modal">
<div class="modal-box w-11/12 max-w-3xl bg-orange-50">
<div class="crear actividad">
    <h4 class="text-center border shadow-lg border-black rounded-sm bg-blue-600 pl-2 w-full mb-2">CREAR ACTIVIDAD:</h4>
    <form action="{{e(route('add.actividad'))}}" class="mx-2 px-2" method="post">
        @csrf
        <div class="grid">
            <label  class="font-semibold my-1 mr-4">Nombre de actividad: 
                <input type="text" name="nombre_actividad" class="border border-blue-400 rounded-md">
            </label>
            <label class="font-semibold my-1 mr-4">Coste individual: 
                <input type="number" name="coste" class="border border-blue-400 rounded-md" value="0" step="any">
            </label>
            <div class="flex">
                <label class="font-semibold my-1 mr-4">Fecha inicio:
                    <input class="border border-blue-400 rounded-md my-2" type="date" name="fecha">
                @error('fecha') <span class=""> {{$message}}</span>@enderror</label>
                <label class="font-semibold my-1 mr-4">Hora inicio:
                    <input class="border border-blue-400 rounded-md my-2" type="time" name="hora">
                @error('hora') <span class=""> {{$message}}</span>@enderror</label>
            </div>
            
            <label class="font-semibold my-1 mr-4">Descripcion: </label>
        </div>
        <textarea name="descripcion_actividad" id="" cols="30" rows="3" class="border border-blue-400 rounded-md mt-4 w-full"></textarea>
        <div class="flex flex-row justify-center my-4 w-full">
            <button class=" btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500 hover:bg-green-700 hover:text-white hover:border-blue-100" type="submit">Crear Actividad</button>
            <label for="my-modal-3" class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-red-500 hover:bg-red-700 hover:text-white">Cancelar</label>
        </div>
        
    </form>
</div>
</div>
</div>
@endif
</div>