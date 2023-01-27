<form action="{{route('updateUser')}}" method="POST">
    @csrf @method('PATCH')
    <label for="foto">Foto</label>
    <img src="" alt="foto perfil"><br>
    <input type="file" name="foto" ><br>
    <label for="nombre_completo">* Nombre completo:</label>
    <input type="text" name="nombre_completo" value="{{$show('nombre_completo')}}" required>@error('nombre_completo') <span> {{$message}}</span> @enderror<br>
    <label for="alias">* Alias:</label>
    <input type="text" name="alias" value="{{$show("alias")}}" required>@error('alias') <span> {{$message}}</span> @enderror<br>
    <label for="email">* Email:</label>
    <input type="email" name="email" value="{{$show('email')}}" required>@error('email') <span> {{$message}}</span> @enderror<br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" value="{{$show('telefono')}}">@error('telefono') <span> {{$message}}</span> @enderror<br>
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion" value="{{$show('direccion')}}">@error('direccion') <span> {{$message}}</span> @enderror<br>
    <label for="localidad">*Localidad:</label>
    <input type="text" name="localidad" value="{{$show('localidad')}}" required>@error('localidad') <span> {{$message}}</span> @enderror<br>
    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" value="{{$show('codigo_postal')}}">@error('codigo_postal') <span> {{$message}}</span> @enderror<br>
    <label for="intereses">Intereses:</label><br>
    <textarea type="text" rows="10" name="intereses" placeholder="#montaña, #playa, #concierto-rock...">{{$show('intereses')}}</textarea>@error('intereses') <span> {{$message}}</span> @enderror<br>
    <label for="password">* Contraseña:</label>
    <input type="password" name="password" required>@error('password') <span> {{$message}}</span> @enderror<br>
    <label for="confirm-password">* Confirmar contraseña:</label>
    <input type="password" name="confirm-password" required>@error('same') <span> {{$message}}</span> @enderror
<br>
    <input type="submit" value="Enviar">
</form>
