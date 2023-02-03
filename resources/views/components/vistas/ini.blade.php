<article>
    <h3 class="bg-green-500 border-2 border-black">EVENTOS ACTIVOS</h3>
    <section>
        <a href="{{e(route('eventosinpresu'))}}">
            <div class="bg-gray-400 border-2 border-black px-2 mx-2 grid md:grid-rows-[0.5fr_0.5fr] md:grid-cols-[0.4fr_1.6fr] grid-rows-[0.3fr_0.3fr_0.3fr] grid-cols-[1fr] overflow-auto">
                <img src="https://mnveek.com/wp-content/uploads/2022/01/MNVEEK_LLEIDA_72_m_5.jpg" alt="Foto del evento" class="md:row-span-2 row-span-1 h-2/3 w-full">
                <div class="flex flex-wrap md:flex-nowrap flex-row items-baseline justify-between">
                    <h4 class="text-xl">$Nombre_Evento</h4>
                    <p>Fecha: $(--/--/-- a --/--/--)</p>
                </div>
                <div class="flex flex-wrap md:flex-nowrap flex-row items-baseline justify-between">
                    <p>$Usuarios: <span>5</span> <span>(Admin: $@-Admin)</span></p>
                    <p>Actividades:<span>5</span></p>
                    <p>$pagado/$APAGAR</p>
                </div>
            </div>
        </a>
    </section>
    </article>
    <hr>
    <article>
    <h3 class="bg-blue-500 border-2 border-black">EVENTOS FINALIZADOS</h3>

    <a href="{{e(route('eventofinalizado'))}}">
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
        </div>
    </a>
    </article>