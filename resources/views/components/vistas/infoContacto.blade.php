<div class="flex items-center border border-black bg-blue-500 p-1">
    <img class="h-14 rounded-full"  src="https://img.freepik.com/fotos-premium/paisaje-verano-relajese-paradise-beach-blue-sea-clean-sand-espacio-copiar_638259-177.jpg?w=2000" alt="foto perfil">
    <p class="bg-yellow-300 rounded-full px-2 ml-2">@-{{$user['alias']}}</p>
</div>
<div class="border border-black rounded-md p-2 bg-slate-300 mx-2">
    <div class="flex justify-between items-center ">

        <div class="flex flex-wrap items-center">
            <img class="h-14 rounded-full"  src="https://img.freepik.com/fotos-premium/paisaje-verano-relajese-paradise-beach-blue-sea-clean-sand-espacio-copiar_638259-177.jpg?w=2000" alt="foto perfil">
            <div class="px-2 ml-2">
                <p class="bg-yellow-300 rounded-full px-1">@-{{$user['alias']}}</p>
            </div>
        </div>
            <div class="items-center border border-black rounded-md bg-blue-500 p-1 mr-4">
                <a class="text-white px-4" href="{{e(route('chat'))}}">Abrir chat</a>
            </div>
    </div>
    <div class="pl-3">
        <p>Ciudad: {{$user['localidad']}}</p>
        <p>Intereses: {{$user['intereses']}}</p>
    </div>

    <div class="flex flex-wrap justify-around">
        <a class="border border-black rounded-md bg-green-700 py-1 p-2 my-2 text-white" href="{{e(route('chatreporte'))}}">Bloquear/Desbloquear</a>
        <x-vistas.botones.agregar-eliminar agregador="{{session('alias')}}" agregado="{{$user['alias']}}"/>

        <a class="border border-black rounded-md bg-red-500 py-1 px-2 my-2 text-white" href="{{e(route('chatreporte'))}}">Reportar</a>
    </div>
</div>
