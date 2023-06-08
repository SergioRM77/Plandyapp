<form action="{{route('updateUser')}}" method="POST" class="grid grid-cols-2" enctype="multipart/form-data">
    @csrf @method('PATCH')
    <label class="col-span-1 my-1" for="foto">Foto</label>
    <img class="col-span-1 h-24 rounded-full"  src="{{session('foto_perfil') != null ? asset(session('foto_perfil')) :
        'https://img2.freepng.es/20190221/gw/kisspng-computer-icons-user-profile-clip-art-portable-netw-c-svg-png-icon-free-download-389-86-onlineweb-5c6f7efd8fecb7.6156919015508108775895.jpg'}}" name="foto" alt="foto perfil">
    <input class=" col-start-2 col-span-1" type="file" name="foto" accept="image/*">
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
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="localidad" value="{{$show('localidad')}}" >@error('localidad') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="codigo_postal">Código Postal:</label>
    <input class="border-2 border-black rounded-md col-span-1 my-1" type="text" name="codigo_postal" value="{{$show('codigo_postal')}}">@error('codigo_postal') <span> {{$message}}</span> @enderror
    <label class="col-span-1 my-1" for="intereses">Intereses:</label>
    <textarea class="border-2 border-black rounded-md col-span-1 my-1" type="text" rows="10" name="intereses" placeholder="#montaña, #playa, #concierto-rock...">{{$show('intereses')}}</textarea>@error('intereses') <span> {{$message}}</span> @enderror
    <div class="grid col-span-2">
        <div class="grid grid-cols-2 my-1 border-2 border-black rounded-md bg-gray-400 p-1">
            <label class="col-span-1 my-1" for="password">Contraseña *: @error('password') <span> {{$message}}</span> @enderror</label>
            <input class="border-2 border-black rounded-md col-span-1 my-1" type="password" name="password" required>
            <label class="col-span-1 my-1" for="confirm-password">Confirmar contraseña *: @error('same') <span> {{$message}}</span> @enderror</label>
            <input class="border-2 border-black rounded-md col-span-1 my-1" type="password" name="confirm-password" required>
        </div>
    </div>

    <input class="btn h-12 mr-1 col-span-1 border-2 border-black rounded-md bg-green-500 hover:bg-green-700" type="submit" value="Actualizar Datos">
    <a class="btn h-12 mr-1 col-span-1 border-2 border-black rounded-md bg-violet-500 hover:bg-violet-700" href="{{e(route('logout'))}}">Cerrar Sesión</a>
</form>

<div >
<form class="grid place-items-center mt-6" action="{{route('deleteUser')}}" method="post">
    @csrf @method('DELETE')
    <button class="btn h-12 w-1/2 my-1 border-2 border-black rounded-md bg-red-500 hover:bg-red-700" type="submit">Borrar cuenta</button>
</form>
</div>