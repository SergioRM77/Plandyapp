<x-layouts.base titulo="chat" metaDescription="Chat privado de Plandyapp">
<article>

<div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
      <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200 bg-blue-300 rounded-lg shadow-lg">
         <div class="relative flex items-center space-x-4">
            <div class="relative">
               <span class="absolute text-green-500 right-0 bottom-0">
                  <svg width="20" height="20">
                     <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                  </svg>
               </span>
            <img src="{{session('foto_perfil')}}" alt="" class="object-cover w-10 sm:w-16 h-10 sm:h-16 rounded-full ml-2">
            </div>
            <div class="flex flex-col leading-tight">
               <div class="text-2xl mt-1 flex items-center">
                  <span class="text-gray-700 mr-3">@-{{session('alias')}}</span>
               </div>
            </div>
         </div>
         <div class="flex items-center space-x-2">
            <p class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver datos usuario</p>
      </div>
</div>
   <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
      <div class="chat-message">
         <div class="flex items-end">
            <div class="flex flex-col space-y-2 max-w-xs mx-2 order-2 items-start">
               <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-blue-300 text-gray-600">Esto es un mensaje de tercero</span></div>
            </div>
         </div>
      </div>
      <div class="chat-message">
         <div class="flex items-end justify-end">
            <div class="flex flex-col space-y-2 max-w-xs mx-2 order-1 items-end">
               <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">Esto es un mensaje mio</span></div>
            </div>
         </div>
      </div>

      </div>
   </div>
   <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
      <div class="relative flex">
         
         <input type="text" placeholder="Escribe tu mensaje!" class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
         <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
            <button type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
               <span class="font-bold">Enviar</span>
            </button>
         </div>
      </div>
   </div>
</div>

<style>
.scrollbar-w-2::-webkit-scrollbar {
width: 0.25rem;
height: 0.25rem;
}

.scrollbar-track-blue-lighter::-webkit-scrollbar-track {
--bg-opacity: 1;
background-color: #f7fafc;
background-color: rgba(247, 250, 252, var(--bg-opacity));
}

.scrollbar-thumb-blue::-webkit-scrollbar-thumb {
--bg-opacity: 1;
background-color: #edf2f7;
background-color: rgba(237, 242, 247, var(--bg-opacity));
}

.scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
border-radius: 0.25rem;
}
</style>

<script>
   const el = document.getElementById('messages')
   el.scrollTop = el.scrollHeight
</script>

</x-layouts.base>