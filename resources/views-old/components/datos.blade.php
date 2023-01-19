<div>
    hola
    @if ($user)
        @foreach($user as $usu)
    <li>{{$usu->name}}</li>
    @endforeach
    @else
        <p>no se han encontrado datos</p>
    @endif
    
</div>