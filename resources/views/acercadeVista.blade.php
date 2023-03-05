<x-layouts.base titulo="Acerca de ..." metaDescription="Acerca de ... Plandyapp">

    <h2>Acerca de ...</h2>
    <div class="max-w-md mx-auto bg-slate-300 rounded-xl shadow-md md:max-w-7xl overflow-auto">
        <div class="md:flex">
            <div class="md:shrink-0">
                <img class="h-32 w-full object-cover md:h-full md:w-48" src="https://s1.eestatic.com/2015/06/09/cocinillas/cocinillas_39756026_116187393_1706x960.jpg" alt="Modern building architecture">
            </div>
            <div class="p-8 lg:w-full">
                <div class="flex flex-wrap items-baseline justify-between">
                    <h4 class="text-xl text-indigo-500">Barbacoa en casa de Antonio</h4>
                    <p class="">Fecha: $(--/--/-- a --/--/--)</p>
                </div>

                <div class="flex flex-wrap items-baseline justify-between">
                    <p>$Usuarios: <span>5</span> <span>(Admin: $@-Admin)</span></p>
                    <p>Actividades:<span>5</span></p>
                    <p>$pagado/$APAGAR</p>
                </div>
            </div>
        </div>
    </div>

      {{-- <a href="{{e(route('eventofinalizado'))}}">
        <div class="bg-gray-400 border-2 border-black px-2 mx-2 grid md:grid-rows-[0.5fr_0.5fr] md:grid-cols-[0.4fr_1.6fr] grid-rows-[0.3fr_0.3fr_0.3fr] grid-cols-[1fr] overflow-auto">
            <img src="https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2021/05/barbacoa-fuego-2326417.jpg" alt="Foto del evento" class="md:row-span-2 row-span-1">
            <div class="flex flex-wrap md:flex-nowrap flex-row items-baseline justify-between">
                <h4 class="text-xl">$Nombre_Evento</h4>
                <p>Fecha: $(--/--/-- a --/--/--)</p>
            </div>
            <div class="flex flex-wrap md:flex-nowrap flex-row items-baseline justify-between">
                <p>$Usuarios: <span>5</span> <span>(Admin: $@-Admin)</span></p>
                <p>Actividades:<span>5</span></p>
                <p>$pagado/$APAGAR</p>
            </div>
        </div> --}}
    </x-layouts.base>