
<article>
    <section class="flex flex-wrap flex-row justify-between mb-10 items-baseline" >
        <form action="{{route('contactos.buscar')}}" method="POST">
            @csrf
            <div>
                <label  for="seach-for-name">Encontrar por nombre:</label>
                <input class="basis-1/4 border rounded-md border-blue-500" type="text" placeholder="buscar por nombre" name="alias">
                <button class="border-2 border-amber-600 rounded-md bg-blue-700 text-amber-400 p-2 mt-2 mx-2" type="submit">Encontrar por nombre</button>
            </div>
        </form>
        
        <form class="flex flex-wrap flex-row justify-between mb-10 items-baseline" action="{{route('contactos.filtrar')}}" method="POST">
            @csrf
            <select class="border border-sky-500 basis-6 p-1 mx-2" name="select">
                <option value="solicitudes" selected>Solicitudes</option>
                <option value="misContactos">Mis contactos</option>
                <option value="bloqueados">Bloqueados</option>
            </select>
            
            <button class="border-2 border-amber-600 rounded-md bg-blue-700 text-amber-400 p-2 mt-2" type="submit">Búsqueda filtrada</button>
        </form>
    </section>
    
    <section>
        @if ($solicitudes != 'NOsolicitudes')

            @foreach ($solicitudes as $solicitud)
            <x-vistas.tiposContactos.infoContacto :user="$solicitud" :agregadorID="$agregadorID" :chatBtnVisible="false">
                <x-vistas.botones.bloquear :bloquear="$solicitud->alias"/>
                @if (in_array($solicitud->id, $agregadorID))
                    <x-vistas.botones.aceptar :agregado="$solicitud->alias"/>
                @endif
                <x-vistas.botones.eliminar :agregado="$solicitud->alias"/>
            </x-vistas.tiposContactos.infoContacto>
        @endforeach  
        @else
            <h3>No hay solicitudes pendientes</h3>
        @endif


    </section>
</article>
