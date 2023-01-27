<x-layouts.base 
    titulo="Evento Sin Presupuesto"
    metaDescription="evento sin presupuesto de Plandyapp">

    <article>
        <h2>Evento Sin presupuesto</h2>
        <div>
            <p>< div con datos de 'Entidad Evento'></p>
            <h3>Nombre de Evento: Nombre</h3>
            <p>Fecha inicio: --/--/--. Fecha fin: --/--/--</p>
            <p>tags: #...., #..., #...</p>
            <p>Foto de evento</p>
            <p>< / div ></p>
        </div>
        <section>
            <div>
                <p>< div con datos de 'tabla usuario_evento' ></p>
                <h3>USUARIOS</h3>
                <p>Nombre de todos los participantes @-user1, @-user2...</p>
                <p>< / div ></p>
            </div>
            <div>
                <p>< div con datos de 'tabla usuario_evento' ></p>
                <h3>ADMINISTRADORES</h3>
                <p>Nombre de todos los Administradores: Principal(@-user1), @-user2...</p>
                <p>< / div ></p>
            </div>
        </section>
        <hr>

        <section>
            <x-operaciones.gastosGenerales idevento='para buscar si tiene gastos'/>
        </section>
        <hr>

        <section>
            <x-operaciones.actividades idevento='para buscar si tiene actividades'/>
        </section>
        <hr>

        <section>
            <x-operaciones.presentarGasto idevento='para saber a qué evento se envia el gasto para estudio'/>
        </section>
        <hr>

        <section>
            <x-operaciones.estadoCuentas idevento='para hacer los cálculos actualizados de un evento'/>
        </section>
        <hr>

        <div>
            <p>< div que contiene datos sobre el dinero entregado y el coste total</p>
            <p>HAS ENTREGADO: 100/120€</p>
            <P>PAGO TOTAL DEL EVENTO: 370/780€</P>
        </div>
    </article>
    
</x-layouts>