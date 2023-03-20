<form action="{{e(route('evento.ver'))}}" method="post">
    @csrf
    
    <button type="submit">
        <input type="hidden" name="id" value="{{$evento['id']}}">
        <div class="max-w-md mx-auto bg-slate-200 rounded-xl shadow-md md:max-w-7xl overflow-auto">
            <div class="md:flex">
                <div class="shrink">
                    <img class="h-32 w-full object-cover md:h-full md:w-48" src="https://s1.eestatic.com/2015/06/09/cocinillas/cocinillas_39756026_116187393_1706x960.jpg" alt="Modern building architecture">
                </div>
                <div class="p-8 lg:w-full">
                    <div class="flex flex-wrap items-baseline justify-between">
                        <h4 class="text-xl text-indigo-500">{{$evento['nombre_evento']}}</h4>
                        <p class="">Fecha: ({{$evento['fecha_inicio']}} a {{$evento['fecha_fin'] == null ? '--/--/--' : $evento['fecha_fin']}})</p>
                    </div>

                    <div class="flex flex-wrap items-baseline justify-between">
                        <p>Participantes: <span>{{$evento['numParticipantes']}}</span> <span>(Admin: @-{{$evento['admin']}})</span></p>
                        <p>Actividades: <span>{{$evento['numActividades']}}</span></p>
                        <p>Pagado: {{$evento['pagado']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </button>
</form>
