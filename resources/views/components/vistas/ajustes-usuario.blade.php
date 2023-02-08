<form action="{{route('updateUser')}}" method="POST" class="grid grid-cols-2">
    @csrf @method('PATCH')
    <label class="col-span-1 my-1" for="foto">Foto</label>
    <img class="col-span-1 h-24 rounded-full"  src="https://img.freepik.com/fotos-premium/paisaje-verano-relajese-paradise-beach-blue-sea-clean-sand-espacio-copiar_638259-177.jpg?w=2000" alt="foto perfil">
    <input class=" col-start-2 col-span-1" type="file" name="foto">
    <label class="col-span-1 my-1" for="nombre_completo">Nombre completo *:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" class="border-2 border-black rounded-md" type="text" name="nombre_completo" value="{{$show('nombre_completo')}}" required>@error('nombre_completo') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="alias">Alias *:</label>
    <p class="border-2 border-black rounded-md col-span-1 my-1">  @error('alias') <span> {{$message}}@enderror</span>{{$show('alias')}} </p> 
    <label class="col-span-1 my-1" for="email">Email *:</label>
    <p class="border-2 border-black rounded-md col-span-1 my-1">  @error('email') <span> {{$message}}@enderror</span>{{$show('email')}} </p> 
    <label class="col-span-1 my-1" for="telefono">Teléfono:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="telefono" value="{{$show('telefono')}}">@error('telefono') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="direccion">Direccion:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="direccion" value="{{$show('direccion')}}">@error('direccion') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="localidad">Localidad *:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="localidad" value="{{$show('localidad')}}" required>@error('localidad') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="codigo_postal">Código Postal:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="codigo_postal" value="{{$show('codigo_postal')}}">@error('codigo_postal') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="intereses">Intereses:</label>
    <textarea class="border-2 border-black rounded-md col-span-1 my-1" type="text" rows="10" name="intereses" placeholder="#montaña, #playa, #concierto-rock...">{{$show('intereses')}}</textarea>@error('intereses') <span> {{$message}}</span> @enderror
    <div class="grid col-span-2">
        <div class="grid grid-cols-2 my-1 border-2 border-black rounded-md bg-gray-400 p-1">
            <label class="col-span-1 my-1" for="password">Contraseña *:</label>
            <input class="border-2 border-black rounded-md col-span-1 my-1" type="password" name="password" required>@error('password') <span> {{$message}}</span> @enderror
            <label class="col-span-1 my-1" for="confirm-password">Confirmar contraseña *:</label>
            <input class="border-2 border-black rounded-md col-span-1 my-1" type="password" name="confirm-password" required>@error('same') <span> {{$message}}</span> @enderror
        </div>
    </div>

    <input class="h-12 mr-1 col-span-1 border-2 border-black rounded-md bg-green-500" type="submit" value="Actualizar Datos">
    <a class="h-12 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border-2 border-black rounded-md bg-violet-500" href="{{e(route('logout'))}}">Cerrar Sesión</a>
</form>

<div >
<form class="grid place-items-center mt-6" action="{{route('deleteUser')}}" method="post">
    @csrf @method('DELETE')
    <button class="h-12 w-1/2 my-1 border-2 border-black rounded-md bg-red-500" type="submit">Borrar cuenta</button>
</form>
</div>