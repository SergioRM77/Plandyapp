<details><summary><div class="flex justify-between items-center border border-black bg-blue-500 hover:bg-blue-700 p-1 rounded-md shadow-lg  shadow-gray-400 mt-2">
    <div class="flex items-center">
        <img class="h-14 w-14 rounded-full object-cover"  src="
        {{ !empty($user->foto) ? asset($user->foto) :
            'https://castillotrans.eu/wp-content/uploads/2019/06/77461806-icono-de-usuario-hombre-hombre-avatar-avatar-pictograma-pictograma-vector-ilustraci%C3%B3n.jpg'
        }}" alt="foto perfil">
        <p class="bg-yellow-300 rounded-full px-2 ml-2">@-{{$user['alias']}}</p>
    </div>
    <p class="btn bg-yellow-300 border-2 border-gray-400 rounded-full hover:bg-orange-400 mr-2">Ver Contacto</p>
    <div class="flex justify-end p-1 mr-4">
        @if ($chatBtnVisible ?? false)
        <a class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded border-b-2 border-green-900" 
            href="{{route('abrirChatPrivadoGet', ['user' => session('alias'), 'contacto' => $user->alias])}}">Abrir chat</a>
        @endif
        
    </div>
</div>
</summary>
    <div class="border border-black rounded-md p-2 bg-slate-300 mx-2" id="datosUsuario{{$user->alias}}">
        <div class="flex justify-between items-center ">

        <div class="pl-3">
            <p>Ciudad: {{$user['localidad']}}</p>
            <p>Intereses: {{$user['intereses']}}</p>
        </div>

        <div class="flex flex-wrap justify-around">
            {{$slot}}
        </div></div>
</details>
</div>
