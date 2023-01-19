<x-layouts.base 
    titulo="Lista de Contactos"
    metaDescription="lista de contactos de usuario de Plandyapp">

    <h2>Lista de contactos</h2>

    <form action="">
        <select name="select">
            <option value="todos">Todos</option>
            <option value="misContactos" selected>Mis contactos</option>
            <option value="bloqueados">Bloqueados</option>
        </select>
        <button type="submit">Buscar</button>
    </form>

    <article>
        <p>< DIVs iterable sobre mis contactos (si es en 'Todos' se muestra un numero determinado de aleatorios)</p>
        <hr>
        <div>
            <p>< div plegado ></p>
            <p>Foto</p>
            <p>@-nombre-user1</p>
            <p>< / div ></p>
        </div>
        <hr>

        <div>
            <p>< div desplegado ></p>
            <p>Foto</p>
            <p>@-nombre-user1</p>
            <p>Ciudad: ...</p>
            <p>Preferencias: #..., #...</p>
            <input type="button" value="Agregar">
            <input type="button" value="Eliminar">
            <input type="button" value="Bloquear/Desbloquear">
            <input type="button" value="Reportar">
            <input type="button" value="Enviar Mensaje">
            <p>< si le das a enviar mensaje o a reportar sale una pequeña ventana para abrir chat o mandar 1 mensaje</p>
            <div>
                <label for="">Enviar mensaje/Reportar</label>
                <input type="text">
                <button type="submit">Enviar Mensaje</button>
                <button type="submit">Abrir chat</button>
            </div>
            <p>< / div ></p>
        </div>
        <p>.......</p>
    </article>
    
</x-layouts>