<x-layouts.base titulo="chat" metaDescription="Chat privado de Plandyapp">

<div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-[calc(100vh-20vh)]">
      <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200 bg-blue-300 rounded-lg shadow-lg">
         <div class="flex items-center space-x-4">  
            @if ($contacto->foto == null)
               <img src="https://castillotrans.eu/wp-content/uploads/2019/06/77461806-icono-de-usuario-hombre-hombre-avatar-avatar-pictograma-pictograma-vector-ilustraci%C3%B3n.jpg"
               alt="foto de perfil de {{$contacto->alias}}" class="object-cover w-10 sm:w-16 h-10 sm:h-16 rounded-full ml-2">
            @else
               <img src="{{asset($contacto->foto)}}" alt="foto de perfil de {{$contacto->alias}}" class="object-cover w-10 sm:w-16 h-10 sm:h-16 rounded-full ml-2">
               
            @endif
            <div class="flex flex-col leading-tight">
               <div class="text-2xl mt-1 flex items-center">
                  <span class="text-gray-700 mr-3">@-{{$contacto->alias}}</span>
               </div>
            </div>
         </div>
         <a href="{{e(route('contactos.ver', $contacto->alias))}}" class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver datos de usuario</a>
</div>
   <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
      @foreach ($conversacion as $mensaje)
      @if ($mensaje->usuario_origen_id != session('id'))
         <div class="chat-message">
            <div class="flex items-end">
               <div class="flex flex-col space-y-2 max-w-xs mx-2 order-2 items-start">
                  <p><span>{{date("d-m-Y H:i", strtotime($mensaje->fecha_y_hora))}}</span></p>
                  <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-blue-300 text-gray-600">{{$mensaje->contenido}}</span></div>
               </div>
            </div>
      </div>
      @else
         <div class="chat-message">
            <div class="flex items-end justify-end">
               <div class="flex flex-col space-y-2 max-w-xs mx-2 order-1 items-end">
                  <p><span>{{date("d-m-Y H:i", strtotime($mensaje->fecha_y_hora))}}</span></p>
                  <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">{{$mensaje->contenido}}</span></div>
               </div>
            </div>
      </div>
      @endif
@endforeach
   </div>
   </div>
      <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
         
            <form action="{{route('enviar.mensaje.privado')}}" method="post">
               @csrf
               <div class="relative flex">
                  <input type="hidden" name="contacto" value="{{$contacto->alias}}">
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