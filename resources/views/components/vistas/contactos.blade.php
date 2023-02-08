
<article>
    <form class="flex flex-wrap flex-row justify-between mb-10 items-baseline" action="" method="POST">
        @csrf
        <select class="border border-sky-500 basis-6 p-1" name="select">
            <option value="todos">Todos</option>
            <option value="misContactos" selected>Mis contactos</option>
            <option value="bloqueados">Bloqueados</option>
        </select>
        <div>
            <label  for="seach-for-name">Buscar por nombre:</label>
            <input class="basis-1/4 border rounded-md border-blue-500" type="text" placeholder="buscar por nombre">
        </div>
        
        <button class="border-2 border-amber-600 rounded-md bg-blue-700 text-amber-400 p-2 mt-2" type="submit">Buscar por nombre</button>
    </form>

    <section>
        @foreach ($users as $user)
        {{-- {{$show($user, 'localidad')}} --}}
            <x-vistas.infoContacto :user="$user"/>
        @endforeach
            
            

    </section>
</article>
