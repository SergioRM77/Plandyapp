<x-layouts.base 
    titulo="Inicio"
    metaDescription="ventana de inicio de Plandyapp">

    <h2>Ventana de inicio</h2>
    <p>Aqui se ve todos los Eventos</p>
    <hr>
    <article>
        <h3>Eventos Activos</h3>
        <section>
            < iteración de entidad eventos mostrando datos básicos y al pinchar redirige>
            <div>
                <p>< div * Ejemplo de evento Con Presupuesto></p>
                <h4>Titulo de Evento</h4>
                <p>Fecha inicio-fin</p>
                <p>Num usuarios: X (Admin. @-user1, @-user2...)</p>
                <p>Precio: pagado/A pagar</p>
                <a href="<?php echo e(route('eventoconpresu')); ?>">Ver Evento con presupuesto</a>
                <p>< / div ></p>
            </div>
            <div>
                <p>< div * Ejemplo de evento Sin Presupuesto></p>
                <h4>Titulo de Evento</h4>
                <p>Fecha inicio-fin</p>
                <p>Num usuarios: X (Admin. @-user1, @-user2...)</p>
                <p>Precio: pagado/A pagar</p>
                <a href="<?php echo e(route('eventosinpresu')); ?>">Ver Evento sin presupuesto</a>
                <p>< / div ></p>
            </div>
        </section>
        <hr>
        <h3>Eventos Finalizados</h3>
        <section>
            < iteración de entidad eventos Finalizados mostrando datos básicos y al pinchar redirige>
            <div>
                <p>< div ></p>
                <h4>Titulo de Evento</h4>
                <p>Fecha inicio-fin</p>
                <p>Num usuarios: X (Admin. @-user1, @-user2...)</p>
                <p>Precio: pagado/A pagar</p>
                <a href="<?php echo e(route('eventofinalizado')); ?>">Ver Evento Finalizado</a>
                <p>< / div ></p>
            </div>
        </section>
    </article>
</x-layouts>