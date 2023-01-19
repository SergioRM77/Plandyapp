@foreach($user as $usu)
    <li>{{$usu->name}}</li>
@endforeach
{{-- {{$user->links()}} --}}