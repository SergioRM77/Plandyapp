<article>
    <h3>CHAT DE EVENTO</h3>
    <section class="mensajes-de-evento">{{-- iteracion de chats de evento --}}
        <h4>Chat Evento: @-nombre</h4>
        <div class="participantes-evento">{{-- iteracion de participantes --}}
            <h5>Participantes</h5>
            <div class="participante">
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
        </div>    
            <a href="{{e(route('chatevento'))}}">abrir chat de evento</a>
    </section>
    <hr>
</article>
<article>
    <h3>CHAT PRIVADOS</h3>
    <section class="mensajes-privados">{{-- iteracion de mensajes privados --}}
        <div class="chat-privado">
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

    