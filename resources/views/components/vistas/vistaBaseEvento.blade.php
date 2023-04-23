<form action="{{e(route('evento.ver.get.get', [$evento['id'], $evento['nombre_evento']]))}}" method="get">
    
    <button type="submit" class="w-full sm:w-3/4">
        <div class="max-w-md mx-auto bg-gradient-to-r from-slate-200 to-orange-50 rounded-lg shadow-md md:max-w-7xl overflow-auto">
            <div class="md:flex">
                <div class="shrink">
                    <img class="h-32 w-full object-cover md:h-full md:w-48" src="
                    {{$evento['foto'] != null ? asset($evento['foto']) :
                        'https://img.freepik.com/vector-premium/paisaje-dibujos-animados-vista-campos-verdes-verano-colina-cesped-primavera-cielo-azul_313905-688.jpg?w=2000'}}" alt="Foto de evento">
                </div>
                <div class="p-8 lg:w-full">
                    <div class="flex flex-wrap items-baseline justify-between">
                        <h4 class="text-xl text-indigo-500">{{$evento['nombre_evento']}}</h4>
                        <p><span class="font-bold">Fecha:</span> ({{$evento['fecha_inicio']}} a {{$evento['fecha_fin'] == null ? '--/--/--' : $evento['fecha_fin']}})</p>
                    </div>

                    <div class="flex flex-wrap items-baseline justify-between">
                        <p><span class="font-bold">Participantes:</span> {{$evento['numParticipantes']}} (<span class="font-bold">Admin:</span> @-{{$evento['admin']}})</p>
                        <p><span class="font-bold">Actividades:</span> {{$evento['numActividades']}}</p>
                        <p><span class="font-bold">Pago TOTAL:</span> {{$evento['pagado']}}€</p>
                    </div>
                </div>
            </div>
        </div>
    </button>
</form>
