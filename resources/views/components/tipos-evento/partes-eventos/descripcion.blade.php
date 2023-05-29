<div class="flex justify-between border border-black rounded-md bg-lime-50 p-3 mb-2">
    <div class="w-2/3">
        @if (session('tipo_evento') == 1)
        <h3 class="text-center border border-black rounded-md bg-yellow-400 font-semibold">Evento SIN PRESUPUESTO</h3>
        @else
        <h3 class="text-center border border-black rounded-md bg-orange-600 font-semibold">Evento CON PRESUPUESTO</h3>
        @endif
        
        @if (session('error_datos_evento'))
                <p>{{session('error_datos_evento')}}</p>
            @endif
        <p><span class="font-semibold italic">Nombre del Evento:</span> {{$evento->nombre_evento}}</p>
        <p><span class="font-semibold italic">Fecha inicio: </span>{{date("d-m-Y", strtotime($evento->fecha_inicio))}}
            <span class="font-semibold italic"> hasta:</span> {{$evento->fecha_fin == null ? '' : date("d-m-Y", strtotime($evento->fecha_fin))}}</p>
        <p><span class="font-semibold italic">Tags:</span> {{$evento->tags}}</p>
        <p><span class="font-semibold italic">Descripcion:</span> {{$evento->descripcion}}</p>
        @if ($evento->is_activo)
            <div class="flex justify-start p-1 mr-4">
                <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded border-b-2 border-green-900" 
                        href="{{route('chatevento',[$evento->nombre_evento, $evento->id, session('alias')])}}">Abrir chat Evento</a>
            </div>
            @endif
        @if ($evento["is_activo"] && $isAdmin->is_admin_principal == true)
            <form action="{{e(route('evento.editar'))}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$evento->id}}">
                <button class="btn border border-black rounded-md bg-green-500 hover:bg-green-700 hover:text-white py-1 p-2 my-2 mx-2 w-24" type="submit">Editar</button>
            </form>
        @endif
        
        
    </div>
    <div class="shrink">
        <img class="h-32 w-full object-cover rounded-md md:h-full md:w-48" src="{{$evento->foto != null ? asset($evento->foto) :
        'https://img.freepik.com/vector-premium/paisaje-dibujos-animados-vista-campos-verdes-verano-colina-cesped-primavera-cielo-azul_313905-688.jpg?w=2000'}}" alt="Foto de evento">
    </div>
</div>