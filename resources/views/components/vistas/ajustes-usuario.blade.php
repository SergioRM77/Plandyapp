

<form action="" method="POST">
    @csrf
    <label for="foto">Foto</label>
    <img src="" alt="foto perfil">
    <input type="file" name="foto" >
    <label for="nombre_completo">Nombre completo:</label>
    <input type="text" name="nombre_completo" >
    <label for="alias">Alias:</label>
    <input type="text" name="alias" value="funcionRecuperarX()">
    <label for="email">Email:</label>
    <input type="text" name="email" value="meme@gmail.me" disabled>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" >
    <label for="direccion">Direccion:</label>
    <input type="text" name="direccion" >
    <label for="localidad">Localidad:</label>
    <input type="text" name="localidad" >
    <label for="codigo_postal">Código Postal:</label>
    <input type="text" name="codigo_postal" >
    <label for="intereses">Intereses:</label>
    <textarea type="text" rows="10" name="intereses" placeholder="#montaña, #playa, #concierto-rock..."></textarea>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" >
    <label for="confirm-password">Confirmar contraseña:</label>
    <input type="password" name="confirm-password" >


    <input type="submit" value="Enviar">
</form>
{{-- <div>
    esto es contenido de AJUSTES
    @foreach($users as $user)
    <li>{{$user->name}}</li>
    @endforeach
    <h4>Ahora de mi Tabla Usuarios</h4>
    @foreach($usuarios as $usuario)
    <li>{{$usuario->nombre_completo}} con alias: {{$usuario->alias}} Con email: {{$usuario->email}}</li>
    @endforeach

    {{$getAllCodigoPostal}}
</div> --}}