<article>
    @error('nombre_evento') <span class=""> {{$message}}</span>@enderror
    <form action="{{ $evento == null ? e(route('evento.guardar')) : e(route('evento.update'))}}" 
    method="post" enctype="multipart/form-data">
    
        @csrf
        @if ($evento == null)
        @method('POST')
        @else
            @method('PATCH')
        @endif
        <input type="hidden" name="id" value="{{$evento->id ?? ''}}">
        <input type="hidden" name="tipo_evento" 
                value="{{$tipo == null ? session('tipo_evento') : ($tipo == "sin-presupuesto" ? 1 : 2)}}">
        <div class="grid grid-cols-3 gap-4 border border-black bg-lime-50 p-3">
            
            <div class="grid col-span-2 grid-rows-7">
                @if ($tipo != null)
                    @if ($tipo != null && $tipo == "con-presupuesto")
                        <h3 class="row-start-1 text-center border border-black rounded-md bg-orange-600 font-semibold">Evento CON PRESUPUESTO</h3>
                    @endif
                    @if ($tipo != null && $tipo == "sin-presupuesto")
                        <h3 class="row-start-1 text-center border border-black rounded-md bg-yellow-400 font-semibold">Evento SIN PRESUPUESTO</h3>
                    @endif
                @else
                    @if (session('tipo_evento' == 1))
                        <h3 class="row-start-1 text-center border border-black rounded-md bg-yellow-400 font-semibold">Evento SIN PRESUPUESTO</h3>
                    @else
                        <h3 class="row-start-1 text-center border border-black rounded-md bg-orange-600 font-semibold">Evento CON PRESUPUESTO</h3>
                    @endif
                @endif

                @if (session('error_datos_evento'))
                    <p>{{session('error_datos_evento')}}</p>
                @endif
                <label class="row-start-2 font-semibold italic" for="nombre_evento"><span>Nombre del Evento:</span>
                <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="nombre_evento" id="" value="{{$evento->nombre_evento ?? ""}}">    
                @error('nombre_evento') 
                    <span class=""> {{$message}} </span> 
                @enderror</label>
                <label class="row-start-3"><span class="font-semibold italic">Fecha inicio: </span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_inicio" id="" value="{{$evento->fecha_inicio ?? ""}}">
                <span class="font-semibold italic"> hasta:</span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_fin" id="" value="{{$evento->fecha_fin ?? ""}}">
                    @error('fecha_inicio') <span> {{$message}}</span>@enderror
                    @error('fecha_fin') <span> {{$message}}</span>@enderror</label>
                <label class="row-start-4 font-semibold italic">Tags:</label>@error('tags') <span> {{$message}}</span>@enderror
                <textarea class="row-start-5 border border-blue-500 rounded-md my-1" name="tags" id="" cols="30" rows="1" >{{$evento->tags ?? ""}}</textarea>
                <label class="row-start-6 font-semibold italic">Descripción:</label>@error('descripcion') <span> {{$message}}</span>@enderror
                <textarea class="row-start-7 border border-blue-500 rounded-md my-1" name="descripcion" id="" cols="30" rows="1">{{$evento->descripcion ?? ""}}</textarea>
            </div>
            <div class="grid place-items-center shrink">
                <img class="h-full w-full object-cover rounded-md md:h-full md:w-48" src="{{!empty($evento->foto) ? asset($evento->foto) : 'https://img.freepik.com/vector-premium/paisaje-dibujos-animados-vista-campos-verdes-verano-colina-cesped-primavera-cielo-azul_313905-688.jpg?w=2000'}}" alt="Foto de evento">
                <input type="file" src="" alt="imagen subida" name="foto" accept="image/*">
            </div>
            @if ($evento == null)
                <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Crear Evento</button>

            @else
            <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Actualizar</button>

            @endif
        </div>
    </form>
</article> 