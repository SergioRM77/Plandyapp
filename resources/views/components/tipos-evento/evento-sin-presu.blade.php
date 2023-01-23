<article>
    <div>
        <h3>Evento SIN PRESUPUESTO</h3>
        <p>Nombre del Evento: $Nombre-Evento</p>
        <p>Fecha inicio: <span class="fecha-inicio">--/--/--</span> 
            hata: <span class="fecha-fin">--/--/--</span></p>
        <p>Tags: #$tags</p>
    </div>
    <div class="participantes">
        <h4>Participantes</h4>
        $lista participantes($pagado/APAGAR)€
    </div>
    <div class="administradores">
        <h4>Administradores:</h4>
        $listaAdmin:@-Principal, @-Secundarios...
    </div>
    <div class="gastos">{{-- iteracion de gastos --}}
        <h4>DESGLOSE DE GASTOS:</h4>
        <div class="gasto">
            <p>Gasto de: $NombreParticipante</p>
            <img src="" alt="foto del gasto">
            <p>Descripcion del gasto: $descripcion</p>
            <p>Coste: $coste</p>
            <p>Fecha: $fecha</p>
        </div>
        
    </div>
    <div class="actividades">{{-- iteracion de actividades --}}
        <h4>ACTIVIDADES:</h4>
        <div class="actividad">
            <p class="estado">estado</p>
            <p>Nombre de actividad: $nombre</p>
            <p>Coste individual: $coste</p>
            <p>Participantes: $listaParticipantes</p>
            <p>Descripcion: $descripcion</p>
        </div>
    </div>
    <div class="presentar gasto">
        <h4>PRESENTAR GASTO:</h4>
        <form action="" method="post">
            <p>Gasto de: $tuNombreUSU</p>
            <img src="" alt="foto opcional de gasto">
            <p>Descripcion: $descripcion</p>
            <p>Coste: $coste</p>
            <p>Fecha: $fechaActual</p>
            <input type="button" value="Subir">
            <input type="button" value="Cancelar">
        </form>
    </div>
    <div class="estado-de-cuantas">
        <h4>ESTADO DE CUENTAS:</h4>
        <p>--Hacer otro componente para cuentas--</p>
    </div>
    
</article>
<article>
    <div>Has entregado: $pagado/APAGAR€</div>
    <div>Pago total del Evento: $pagadoTodos/APAGARTODOS€</div>
</article>