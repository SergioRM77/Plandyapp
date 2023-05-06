
<x-layouts.base titulo="chat Evento" metaDescription="Chat evento de Plandyapp"><article>
      <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-[calc(100vh-20vh)]">
         <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200 bg-blue-300 rounded-lg shadow-lg">
            <div class="flex items-center space-x-4">  
               
               <div class="flex flex-col leading-tight">
                  <div class="text-2xl mt-1 flex items-center">
                     <span class="text-gray-700 mr-3">{{$nombre_evento}}</span>
                  </div>
               </div>
            </div>
            <div class="flex items-center space-x-2">
               <p class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver datos usuario</p>
         </div>
   </div>
      <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
         
         @foreach ($chatEvento as $mensaje)
         @if ($mensaje->usuario_id != session('id'))
            <div class="chat-message">
               <div class="flex items-end">
                  <div class="flex flex-col space-y-2 max-w-xs mx-2 order-2 items-start">
                     <p><span class="bg-yellow-300 rounded-full px-1 shadow-md">@-{{$mensaje->alias}}</span> <span>{{date("d-m-Y H:i", strtotime($mensaje->fecha_y_hora))}}</span></p>
                     <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-blue-300 text-gray-600 shadow-md">{{$mensaje->contenido}}</span></div>
                  </div>
               </div>
         </div>
         @else
            <div class="chat-message">
               <div class="flex items-end justify-end">
                  <div class="flex flex-col space-y-2 max-w-xs mx-2 order-1 items-end">
                     <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white shadow-md">{{$mensaje->contenido}}</span></div>
                  </div>
               </div>
         </div>
         @endif
   @endforeach
      </div>
      </div>
         <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            
               <form action="{{route('enviar.mensaje.chat.evento')}}" method="post">
                  @csrf
                  <div class="relative flex">
                     <input type="hidden" name="nombre_evento" value="{{$nombre_evento}}">
                     <input type="hidden" name="id_evento" value="{{$id_evento}}">
                     <input type="hidden" name="user" value="{{session('alias')}}">
                     <input type="text" name="contenido" placeholder="Escribe tu mensaje!"  autocomplete="off" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
                     <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
                     <button type="submit" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">enviar mensaje</button>
                  </div>
               </form>
            
         </div>
      </div>
   </div>
   
   </div>
   <script>
      const el = document.getElementById('messages')
      el.scrollTop = el.scrollHeight
   </script>
</x-layouts.base>