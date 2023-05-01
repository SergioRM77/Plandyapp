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
            
            {{-- <form class="items-center border border-black rounded-md bg-blue-500 p-1 mr-4" action="{{route('abrirChatPrivado')}}" method="POST">
            @csrf
            <input type="hidden" name="usuario_id" value="{{$user['id']}}">
                <button class="text-white px-4" >Abrir chat</button>
            </form> --}}
            <form class="items-center border border-black rounded-md bg-blue-500 p-1 mr-4" action="{{route('abrirChatPrivadoGet', [session('alias'),$user['alias']])}}" method="GET">
                {{-- <input type="hidden" name="usuario_id" value="{{$user['id']}}"> --}}
                    <button class="text-white px-4" >Abrir chat</button>
                </form>
    </div>
    <div class="pl-3">
        <p>Ciudad: {{$user['localidad']}}</p>
        <p>Intereses: {{$user['intereses']}}</p>
    </div>

    <div class="flex flex-wrap justify-around">
        
        {{$slot}}
    </div>
</div>
