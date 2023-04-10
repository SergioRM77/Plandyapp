<h5 class="border border-black bg-blue-400 pl-2 mx-1" id="gasto">GASTO</h5>
    <div class="border border-black rounded-b-lg mx-2">
        @if ($gastos != null)
            @foreach ($gastos as $id => $gasto)
                <div class=" mx-auto overflow-hidden">
                    @if (($isAdmin->is_admin_principal == true && $gasto->is_aceptado == false) || 
                        ($isAdmin->is_admin_secundario == true && $gasto->is_aceptado == false) ||
                        $gasto->is_aceptado == true)
                        <div class="md:flex justify-between">
                            <div class="px-8">
                                <p><span class="font-semibold">Gasto de: </span><span class="bg-yellow-300 rounded-full px-2">@-{{$gasto->alias}}</span></p>
                                <p><span class="font-semibold">Coste: </span> {{$gasto->coste}}</p>
                                <p><span class="font-semibold">Fecha: </span>{{date("d-m-Y H:i", strtotime($gasto->created_at))}}</p>
                                <p><span class="font-semibold">Descripcion del gasto:</span> {{$gasto->descripcion}}</p>
                            </div>
                            <div class="flex md:shrink-0 items-center p-2">
                                <img class="h-32 w-full object-cover rounded-md md:w-48" src="{{$gasto->foto != null ? asset($gasto->foto) :
                                    'https://img.freepik.com/vector-premium/paisaje-dibujos-animados-vista-campos-verdes-verano-colina-cesped-primavera-cielo-azul_313905-688.jpg?w=2000'}}" alt="Foto de Gasto">
                            </div>
                        </div>
                    @endif
                    <div class="flex">
                        @if (($isAdmin->is_admin_principal == true || $isAdmin->is_admin_secundario == true)  && $gasto->is_aceptado == false && $evento["is_activo"])
                            <form action="{{e(route('gasto.evento.aceptar'))}}" method="post">
                                @csrf
                                <input type="hidden" name="gasto_id" value="{{$gasto->id}}">
                                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                                <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Aceptar Gasto</button>
                            </form>
                        @endif
                        @if ($evento["is_activo"] && ($isAdmin->is_admin_principal || $isAdmin->is_admin_secundario) )
                            <form action="{{e(route('gasto.evento.eliminar'))}}" method="post">
                                @csrf
                                <input type="hidden" name="gasto_id" value="{{$gasto->id}}">
                                <input type="hidden" name="evento_id" value="{{$evento->id}}">
                                <button class="border border-black rounded-md bg-red-700 py-1 p-2 my-2 mx-2" type="submit">Eliminar Gasto</button>
                            </form>
                        @endif
                    </div>
                    
                </div>
            @endforeach
        @else
            <p>No hay gastos presentados</p>
        @endif

    </div>

    </div>
    @if ($evento["is_activo"])
    <div class="presentar gasto">
        <h4 class="border border-black bg-blue-600 pl-2">PRESENTAR GASTO:</h4> 
        <form class="border border-black  mx-2 px-2" action="{{e(route('evento.add.gasto'))}}" method="post" enctype="multipart/form-data">
            @csrf
            @if (session('error_gasto'))<p class="w-full">{{session('error_gasto')}}</p>@endif
            <input type="hidden" name="evento_id" value="{{$evento->id}}">
            <label class="font-semibold">Gasto de:<span class="bg-yellow-300 rounded-full px-2">@-{{session('alias')}}</span></label>

            <div class="grid grid-cols-3">
                <div class="grid grid-cols-1">
                    
                    <label class="col-span-1 row-span-3 font-semibold" for="coste">Coste:
                        <input class="col-span-2 border border-blue-400 rounded-md my-4" type="number" name="coste" value="0" step="any"></label>

                    <label class="col-span-1 row-span-2 font-semibold">Descripcion del gasto:
                        <textarea class="col-span-2 border border-blue-400 rounded-md mt-4" name="descripcion" id="" cols="30" rows="3"></textarea></label>

                </div>
                <div class="grid grid-cols-1">

                </div>
                <div class="grid grid-cols-1 justify-items-center items-center">
                    <input class="border-2 border-blue-800 border-dashed rounded-md bg-blue-400 px-6 py-6" type="file" name="foto" value="Subir foto" accept="image/*">
                </div>
            </div>

            <div class="flex flex-row justify-center my-4">
                <input class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit" value="Subir">
                <a class="basis-1/4 h-10 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border border-black rounded-md bg-red-500" href="{{e(route('evento.ver.get', session('evento_id')))}}">Cancelar</a>
            </div>
        </form>
    </div>
    @endif