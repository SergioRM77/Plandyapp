<div class="actividades">
    <h4 class="border border-black bg-violet-400 pl-2">ACTIVIDADES:</h4>
    <div class="border border-black rounded-b-lg mx-2 px-2">
        @if (count($actividades)>0)
            @foreach ($actividades as $item => $actividad)
            <div class="flex items-center">
                <div class="flex-none border border-black rounded-full p-2 w-1 h-1  
                {{date("Y-m-d H:i") > date("Y-m-d H:i", strtotime($actividad->fecha . $actividad->hora)) ? 'bg-red-600'
                : ' bg-green-600'}}"></div>
                <div class="grid md:grid-rows-1 md:grid-cols-3 grid-rows-2 grid-cols-1 border border-black rounded-md w-full m-2 px-2">
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
                                <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-red-500 my-2 mx-2 w-4/6" type="submit">Eliminar</button>

                            </form>
                            <form action="{{e(route('editar.actividad'))}}" method="post">
                                @csrf
                                <input type="hidden" name="id_actividad" value="{{$actividad->id}}">
                                <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500 my-2 mx-2 w-4/6"  type="submit">Actualizar</button>
                            </form>
                            {{-- <a href="{{e(route('editar.actividad', $actividad->id))}}" class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500">Actualizar Actividad</a> --}}
                        @endif
                        
                            
                        @foreach ($listaParticipantesActividades as $key => $participanteActividad)
                            @if ($evento["is_activo"] && $participanteActividad->actividad_id == $actividad->id && $participanteActividad->participante_id == session('id'))
                                <form action="{{e(route('delete.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-yellow-500 my-2 mx-2 w-4/6" type="submit">Salirse</button>
                                </form>
                                @break
                            @endif
                            @if ($evento["is_activo"] && isset($listaParticipantesActividades[$key+1]) == false && count($listaParticipantesActividades)  == $key+1)
                                <form action="{{e(route('add.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-blue-500 my-2 mx-2 w-4/6" type="submit">Unirse</button>
                                </form>
                            @endif
                            @endforeach
                            @if ($evento["is_activo"] && count($listaParticipantesActividades) == 0)
                                <form action="{{e(route('add.participante.actividad'))}}" method="post">
                                    @csrf
                                    <input type="hidden" name="actividad_id" value="{{$actividad->id}}">
                                    <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-blue-500 my-2 mx-2 w-4/6" type="submit">Unirse a Actividad</button>
                                </form>
                            @endif
                    </div>

            </div>
    </div>
            @endforeach

        @else
            <p>No hay actividades</p>
        @endif

</div>

@if ($evento["is_activo"] && ($isAdmin->is_admin_principal == true || $isAdmin->is_admin_secundario == true))
<div class="flex justify-center">
    <label for="my-modal-2" class="border-black w-2/5 btn py-2 px-4 bg-violet-400 text-white font-semibold shadow-md hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
        <lord-icon
            src="https://cdn.lordicon.com/mecwbjnp.json"
            trigger="hover">
        </lord-icon>
        Crear Actividad
    </label>
</div>

<input type="checkbox" id="my-modal-2" class="modal-toggle" />
    <div class="modal">
    <div class="modal-box w-11/12 max-w-full">

<div class="crear actividad mx-2 px-2">
    <h4 class="border border-black bg-violet-400 pl-2">CREAR ACTIVIDAD:</h4>
    <form action="{{e(route('add.actividad'))}}" class="border border-black rounded-md w-full mx-2 px-2  bg-orange-100" method="post">
        @csrf
        <div class="grid">
            <label class="my-1 font-semibold">Nombre de actividad: 
                <input type="text" name="nombre_actividad" class="col-span-2 border border-blue-400 rounded-md my-2">
            </label>
            <label class="font-semibold">Coste individual: 
                <input type="number" name="coste" class="col-span-2 border border-blue-400 rounded-md my-2" value="0" step="any">
            </label>
            <label class=" font-semibold">Fecha inicio:
                <input class="border border-blue-400 rounded-md my-2" type="date" name="fecha">
                @error('fecha') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Hora inicio:
                <input class="border border-blue-400 rounded-md my-2" type="time" name="hora">
                @error('hora') <span class=""> {{$message}}</span>@enderror</label>
            <label class="font-semibold">Descripcion: </label>
        </div>
        <textarea name="descripcion_actividad" id="" cols="30" rows="3" class="col-span-2 border border-blue-400 rounded-md my-2"></textarea>
        <button class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit">Crear Actividad</button>
        {{-- <a class="basis-1/4 h-10 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border border-black rounded-md bg-red-500" href="{{e(route('evento.ver.get', session('evento_id')))}}">Cancelar</a> --}}
        <label for="my-modal-2" class="btn basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-red-500">Cancelar</label>

    </form>
</div>
</div>
</div>
@endif