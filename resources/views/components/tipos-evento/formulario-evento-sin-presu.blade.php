<article>
    <form 
    @if ($evento == null)
    action="{{e(route('evento.sinpresu.guardar'))}}" 
    @else
    action="{{e(route('evento.sinpresu.update'))}}" 
    @endif
    
    
    method="post">
        @csrf
        <input type="hidden" name="id" value="{{$evento->id ?? ''}}">
        <div class="grid grid-cols-3 gap-4 border border-black bg-lime-50 p-3">
            <div class="grid col-span-2 grid-rows-7">
                <h3 class="row-start-1 text-center border border-black rounded-md bg-yellow-400 font-semibold">Evento SIN PRESUPUESTO</h3>
                <label class="row-start-2 font-semibold italic"><span>Nombre del Evento:</span>
                <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="nombre_evento" id="" value="{{$evento->nombre_evento ?? ""}}">
                @error('nombre_evento') <span class=""> {{$message}}</span>@enderror</label>
                <label class="row-start-3"><span class="font-semibold italic">Fecha inicio: </span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_inicio" id="" value="{{$evento->fecha_inicio ?? ""}}">
                <span class="font-semibold italic"> hata:</span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_fin" id="" value="{{$evento->fecha_fin ?? ""}}">
                    @error('fecha_inicio') <span> {{$message}}</span>@enderror
                    @error('fecha_fin') <span> {{$message}}</span>@enderror</label>
                <label class="row-start-4 font-semibold italic">Tags:</label>@error('tags') <span> {{$message}}</span>@enderror
                <textarea class="row-start-5 border border-blue-500 rounded-md my-1" name="tags" id="" cols="30" rows="1" >{{$evento->tags ?? ""}}</textarea>
                <label class="row-start-6 font-semibold italic">Descripción:</label>@error('descripcion') <span> {{$message}}</span>@enderror
                <textarea class="row-start-7 border border-blue-500 rounded-md my-1" name="descripcion" id="" cols="30" rows="1">{{$evento->descripcion ?? ""}}</textarea>
            </div>
            <div class="grid place-items-center shrink">
                <img class="h-full w-full object-cover rounded-md md:h-full md:w-48" src="https://s1.eestatic.com/2015/06/09/cocinillas/cocinillas_39756026_116187393_1706x960.jpg" alt="Modern building architecture">
            </div>
            @if ($evento == null)
                <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Crear Evento</button>

            @else
            <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Actualizar</button>

            @endif
        </div>
        @if ($evento != null)
            </form>
            <h4 class="border border-black bg-violet-400 pl-2">Participantes</h4>
            <form action="" method="post">
                <div class="border border-black rounded-b-lg p-2 mx-2">
                    $lista participantes($pagado/APAGAR)€
                    
                </div>
            </form>
    
    
                <div class="flex border border-black bg-violet-400 pl-2">
                <h4>Administradores: </h4>
                <p><span class="bg-yellow-300 rounded-full px-2">@-Principal</span>, <span class="bg-yellow-300 rounded-full px-2">@-Secundarios</span>...</p>
            </div>

                <h4 class="flex border border-black bg-violet-400 pl-2">DESGLOSE DE GASTOS:</h4>

                
                
                <h5 class="border border-black bg-blue-600 pl-2 mx-1">GASTO</h5>
                    <div class="border border-black rounded-b-lg mx-2">
                        <div class=" mx-auto overflow-hidden">
                            @if ($gastos != null)
                            @foreach ($gastos as $id => $gasto)
                                <div class=" mx-auto overflow-hidden">
                                <div class="md:flex justify-between">
                                        <div class="px-8">
                                            <p><span class="font-semibold">Gasto de: </span><span class="bg-yellow-300 rounded-full px-2">@-{{$gasto->alias}}</span></p>
                                            <p><span class="font-semibold">Coste: </span> {{$gasto->coste}}</p>
                                            <p><span class="font-semibold">Fecha: </span>{{$gasto->created_at}}</p>
                                            <p><span class="font-semibold">Descripcion del gasto:</span> {{$gasto->descripcion}}</p>
                                        </div>
                                        <div class="flex md:shrink-0 items-center p-2">
                                            <img class="h-32 w-full object-cover rounded-md md:w-48" src="https://img.freepik.com/vector-premium/paisaje-dibujos-animados-vista-campos-verdes-verano-colina-cesped-primavera-cielo-azul_313905-688.jpg?w=2000" alt="Modern building architecture">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No hay gastos presentados</p>
                        @endif
                    </div>
                </div>
                
            <div class="presentar gasto">
                <h4 class="border border-black bg-violet-400 pl-2">PRESENTAR GASTO:</h4>
                <form class="border border-black  mx-2 px-2" action="{{e(route('evento.add.gasto'))}}" method="post">
                    @csrf
                    <input type="hidden" name="evento_id" value="{{$evento->id}}">
                    <label class="font-semibold">Gasto de:<span class="bg-yellow-300 rounded-full px-2">@-{{session('alias')}}</span></label>

                    <div class="grid grid-cols-3">
                        <div class="grid grid-cols-1">
                            <label class="col-span-1 row-span-3 font-semibold">Coste: 
                                <input class="col-span-2 border border-blue-400 rounded-md my-4" type="number" name="coste" min="0" value="0" step="any">
                                </label>
                            <label class="col-span-1 row-span-2 font-semibold">Descripcion del gasto:</label>
                                <textarea class="col-span-2 border border-blue-400 rounded-md mt-4" name="descripcion" id="" cols="30" rows="3"></textarea>
                            

                        </div>
                        <div class="grid grid-cols-1">

                        </div>
                        <div class="grid grid-cols-1 justify-items-center items-center">
                            <input class="border-2 border-blue-800 border-dashed rounded-md bg-blue-400 px-6 py-6" type="image" value="Subir foto">
                        </div>
                    </div>

                    <div class="flex flex-row justify-center my-4">
                        <input class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit" value="Subir">
                        <a class="basis-1/4 h-10 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border border-black rounded-md bg-red-500" href="">Cancelar</a>
                    </div>
                </form>
            </div>
                
                
            <div class="actividades">
                <h4 class="border border-black bg-violet-400 pl-2">ACTIVIDADES:</h4>

                <div class="border border-black rounded-b-lg mx-2 px-2">
                    <div class="flex items-center">
                        <div class="flex-none border border-black rounded-full p-2 w-1 h-1 bg-green-600"></div>
                        <div class="border border-black rounded-md w-full m-2 px-2">
                            <p><span class="font-semibold">Nombre de actividad: </span>$nombre</p>
                            <p><span class="font-semibold">Coste individual: </span>$coste</p>
                            <p><span class="font-semibold">Participantes: </span>$listaParticipantes</p>
                            <p><span class="font-semibold">Descripcion: </span>$descripcion</p>
                            <label class="col-span-1 row-span-2 font-semibold">Fecha inicio:
                                <input class="col-span-2 border border-blue-400 rounded-md my-4" type="date" name="fecha">
                                @error('fecha') <span class=""> {{$message}}</span>@enderror</label>
                            <label class="col-span-1 row-span-2 font-semibold">Hora inicio:
                                <input class="col-span-2 border border-blue-400 rounded-md my-4" type="time" name="hora">
                                @error('hora') <span class=""> {{$message}}</span>@enderror</label>
                        </div>
                    </div>
                </div>

            </div>



            <h4 class="border border-black bg-violet-400 pl-2">ESTADO DE CUENTAS:</h4>
            <div class="border border-black rounded-b-lg mx-2 px-2">
                
                <p>$lista de participantes, ejemplo ->  @-aLexA654 (100/100€), @-AleXTinTin.77 (100/130€), @-Patricio001 (125/100€),
                @-55-jperex-SS (84/130€), @-PIPOL1P0 (90/130€), @-UsubP67 (103/100€),
                </p>
                <div class="flex mt-4">
                    <div class="w-1/2">
                        <h5>USUARIOS QUE DEBEN A USUARIOS</h5>
                    </div>
                    <div class="w-1/2">
                        <h5>GASTOS GENERALES</h5>
                    </div>
                </div>
            </div>
            
        </article>
        <article class="my-10">
            <h4 class="border border-black text-center bg-green-500">Has entregado: $pagado/APAGAR€</h4>
            <h4 class="border border-black text-center bg-green-800">Pago total del Evento: $pagadoTodos/APAGARTODOS€</h4>
        </article>
    @endif
    
</article>
