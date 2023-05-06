<article>
    
    <section class="mensajes-chat">
        <h3 class="border border-black bg-green-300 pl-2 mx-1 text-center">CHATS PRIVADOS</h3>
        @foreach ($chatPrivados as $usuario)
            <div class="">
                    <div class="flex items-center justify-between border rounded-md border-black bg-blue-500 p-1">
                        <div class="flex items-center">
                            @if ($usuario->foto == null)
                            <lord-icon class="object-cover w-10 sm:w-16 h-10 sm:h-16 rounded-full ml-2"
                                src="https://cdn.lordicon.com/bhfjfgqz.json"
                                trigger="hover"
                                colors="primary:#121331">
                                </lord-icon>
                            @else
                                <img src="{{asset($usuario->foto)}}" alt="" class="object-cover w-10 sm:w-16 h-10 sm:h-16 rounded-full ml-2">
                            @endif
                            <p class="bg-yellow-300 rounded-full px-2">@-{{$usuario->alias}} </p>
                        </div>
                        <a href="{{e(route('contactos.ver', $usuario->alias))}}" class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver datos de usuario</a>
                        <div class="flex justify-end p-1 mr-4">
                            <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded border-b-2 border-green-900" 
                                    href="{{route('abrirChatPrivadoGet', ['user' => session('alias'), 'contacto' => $usuario->alias])}}">Abrir chat</a>
                        </div>
                    </div>
            </div>
        @endforeach
        
    </section>
    <hr class="border border-black my-2 rounded-full">
    <section>
        <h3 class="border border-black bg-orange-400 pl-2 mx-1 text-center">CHATS DE EVENTOS</h3>
        @foreach ($eventosChat as $evento)
            <div class="">
                    <div class="flex items-center justify-between border rounded-md border-black bg-blue-400 p-1">
                        <div class="flex items-center bg-orange-400 p-2">
                            <p>Nombre: <span class="bg-yellow-300 rounded-md px-2">{{$evento->nombre_evento}}</span> </p>
                        </div>
                        <a href="{{e(route('evento.ver.get.get', [$evento->id, $evento->nombre_evento]))}}" class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver Evento</a>
                        <div class="flex justify-end p-1 mr-4">
                            <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded border-b-2 border-green-900" 
                                    href="{{route('chatevento',[$evento->nombre_evento, $evento->id, session('alias')])}}">Abrir chat Evento</a>
                        </div>
                    </div>
            </div>
        @endforeach
    </section>
    <hr>
</article>


{{-- 

<article>
    <h3>CHAT PRIVADOS</h3>
    <section class="mensajes-privados">
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

     --}}