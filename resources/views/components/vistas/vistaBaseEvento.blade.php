<form action="{{e(route('evento.ver'))}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$evento->id}}">
    <button type="submit">
        
        <div class="max-w-md mx-auto bg-slate-200 rounded-xl shadow-md md:max-w-7xl overflow-auto">
            <div class="md:flex">
                <div class="shrink">
                    <img class="h-32 w-full object-cover md:h-full md:w-48" src="https://s1.eestatic.com/2015/06/09/cocinillas/cocinillas_39756026_116187393_1706x960.jpg" alt="Modern building architecture">
                </div>
                <div class="p-8 lg:w-full">
                    <div class="flex flex-wrap items-baseline justify-between">
                        <h4 class="text-xl text-indigo-500">{{$evento->nombre_evento}}</h4>
                        <p class="">Fecha: ({{$evento->fecha_inicio}} a {{$evento->fecha_fin}})</p>
                    </div>

                    <div class="flex flex-wrap items-baseline justify-between">
                        <p>$Usuarios: <span>5</span> <span>(Admin: $@-Admin)</span></p>
                        <p>Actividades:<span>5</span></p>
                        <p>$pagado/$APAGAR</p>
                    </div>
                </div>
            </div>
        </div>
    </button>
</form>
