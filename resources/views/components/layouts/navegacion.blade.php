<nav>
    <ul>
        <li><a href="{{ e(route('contactos')) }}">Lista Contactos</a></li>
        <li><a href="{{ e(route('inicio')) }}">Ver Evento</a> -al pinchar aqui abre inicio con Eventos activos Desplegados</li>
        <li><a href="{{ e(route('inicio')) }}">Evento Finalizado</a> -al pinchar aqui abre inicio con Eventos finalizados Desplegados</li>
        <li><a href="">Crear Evento</a> -al pinchar sale emergente preguntando qué tipo de evento</li>
        <li><a href="{{ e(route('mensajeria')) }}">Mensajería</a></li>
        <li><a href="{{ e(route('ajustes')) }}">Ajustes</a></li>
        <li><a href="{{ e(route('acercade')) }}">Acerca de</a></li>
        <li><a href="{{e(route('logout'))}}">Cerrar sesion</a></li>
    </ul>
</nav>