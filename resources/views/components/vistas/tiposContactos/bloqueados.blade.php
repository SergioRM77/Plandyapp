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
                    <option value="solicitudes">Solicitudes</option>
                    <option value="misContactos">Mis contactos</option>
                    <option value="bloqueados" selected>Bloqueados</option>
                </select>
                
                <button class="border-2 border-amber-600 rounded-md bg-blue-700 text-amber-400 p-2 mt-2" type="submit">Búsqueda filtrada</button>
            </form>
        </section>
        
    <section>
        @if (count($users)>0)
            @foreach ($users as $user)
                    <x-vistas.tiposContactos.infoContacto :user="$user"  :chatBtnVisible="false">
                        <x-vistas.botones.desbloquear :desbloquear="$user->alias ?? ''"/>
                        <x-vistas.botones.eliminar :agregado="$user->alias ?? ''"/>
                    </x-vistas.tiposContactos.infoContacto>
                @endforeach   
        @else
            <h3>No hay contactos bloqueados</h3>
        @endif
    </section>
</article>
