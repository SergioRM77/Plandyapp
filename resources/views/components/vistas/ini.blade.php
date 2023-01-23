<article>
    <h3>EVENTOS ACTIVOS</h3>
    <section>{{-- iteracion  de eventos activos en caso de existir --}}
        <a href="{{e(route('eventosinpresu'))}}">
            <div class="evento-activo">
                <img src="" alt="Foto del evento">
                <h4>$Nombre_Evento</h4>
                <p>Fecha: $(--/--/-- a --/--/--)</p>
                <p>$Numero Usuarios <span>(Admin: $@-Nombre-Admin)</span></p>
                <p>$pagado/$APAGAR</p>
            </div>
        </a>
    </section>
    </article>
    <hr>
    <article>
    <h3>EVENTOS FINALIZADOS</h3>
    <section>{{-- iteracion  de eventos finalizados en caso de existir --}}
        <a href="{{e(route('eventofinalizado'))}}">
            <div class="evento-finalizado">
                <img src="" alt="Foto del evento">
                <h4>$Nombre_Evento</h4>
                <p>Fecha: $(--/--/-- a --/--/--)</p>
                <p>$Numero Usuarios <span>(Admin: $@-Nombre-Admin)</span></p>
                <p>$pagado/$APAGAR</p>
            </div>
        </a>
    </section>
    </article>