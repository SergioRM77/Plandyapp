
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

    <section>
        <div>
            <div>Foto</div>
            <p>Nombre Usuario:</p>
            <p>Ciudad:</p>
            <p>Intereses:</p>
            <div>
                <input type="button" value="Agregar">
                <input type="button" value="Eliminar">
                <input type="button" value="Bloquear/Desbloquear">
                <input type="button" value="Reportar">
                <input type="button" value="Enviar Mensaje">
            </div>
            <div>
                <label for="">Enviar mensaje/Reportar</label>
                <input type="text">
                <button type="submit">Enviar Mensaje</button>
                <button type="submit">Abrir chat</button>
            </div>
        </div>
        

    </section>
</article>
