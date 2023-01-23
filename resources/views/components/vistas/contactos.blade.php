
<article>
    <form action="" method="POST">
        @csrf
        <select name="select">
            <option value="todos">Todos</option>
            <option value="misContactos" selected>Mis contactos</option>
            <option value="bloqueados">Bloqueados</option>
        </select>
        <button type="submit">Buscar</button>
        <label for="seach-for-name">Buscar por nombre:</label>
        <input type="text" value="buscar">
        <button type="submit">Buscar por nombre</button>
    </form>

    <section>{{-- iteracion sobre busqueda seleccionada --}}
        <div>
            <div>Foto</div>
            <p>Nombre Usuario:</p>
            <p>Ciudad:</p>
            <p>Intereses:</p>
            <form action="" method="POST">
                <a href="{{e(route('chat'))}}">Abrir chat</a>
                <a href="{{e(route('chatreporte'))}}">Abrir Chat Reporte</a>
                <input type="button" value="Agregar/Eliminar">
                <input type="button" value="Bloquear/Desbloquear">
                <input type="button" value="Reportar">
                <input type="button" value="Enviar Mensaje">
            
                <label for="">Enviar mensaje/Reportar</label>
                <input type="text">
                <button type="submit">Enviar</button>
                
            </form>
        </div>
        

    </section>
</article>
