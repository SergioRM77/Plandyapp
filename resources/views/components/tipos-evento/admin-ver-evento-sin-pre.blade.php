<article>
    <form action="{{e(route('evento.sinpresu.editar'))}}" method="post">
        @csrf
        <div class="grid grid-cols-3 gap-4 border border-black bg-lime-50 p-3">
            <div class="grid col-span-2 grid-rows-7">
                <h3 class="row-start-1 text-center border border-black rounded-md bg-yellow-400 font-semibold">Evento SIN PRESUPUESTO</h3>
                <label class="row-start-2 font-semibold italic"><span>Nombre del Evento:</span>
                <input class="w-full border border-blue-500 rounded-md my-1" type="text" name="nombre_evento" id="">
                @error('nombre_evento') <span class=""> {{$message}}</span>@enderror</label>
                <label class="row-start-3"><span class="font-semibold italic">Fecha inicio: </span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_inicio" id="">
                <span class="font-semibold italic"> hata:</span>
                    <input class="border border-blue-500 rounded-md my-1" type="date" name="fecha_fin" id="">
                    @error('fecha_inicio') <span> {{$message}}</span>@enderror
                    @error('fecha_fin') <span> {{$message}}</span>@enderror</label>
                <label class="row-start-4 font-semibold italic">Tags:</label>@error('tags') <span> {{$message}}</span>@enderror
                <textarea class="row-start-5 border border-blue-500 rounded-md my-1" name="tags" id="" cols="30" rows="1"></textarea>
                <label class="row-start-6 font-semibold italic">Descripción:</label>@error('descripcion') <span> {{$message}}</span>@enderror
                <textarea class="row-start-7 border border-blue-500 rounded-md my-1" name="descripcion" id="" cols="30" rows="1"></textarea>
            </div>
            <div class="grid place-items-center shrink">
                <img class="h-full w-full object-cover rounded-md md:h-full md:w-48" src="https://s1.eestatic.com/2015/06/09/cocinillas/cocinillas_39756026_116187393_1706x960.jpg" alt="Modern building architecture">
            </div>
            <button class="border border-black rounded-md bg-green-500 py-1 p-2 my-2 mx-2" type="submit">Enviar</button>
        </div>
        
    </form>
</article>
