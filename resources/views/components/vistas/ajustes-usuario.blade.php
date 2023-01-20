
<div>
    esto es contenido de AJUSTES
    @foreach($users as $user)
    <li>{{$user->name}}</li>
    @endforeach
    <h4>Ahora de mi Tabla Usuarios</h4>
    @foreach($usuarios as $usuario)
    <li>{{$usuario->nombre_completo}} con alias: {{$usuario->alias}} CP: {{$usuario->codigo_postal}}</li>
    @endforeach

    {{$getAllCodigoPostal}}
</div>