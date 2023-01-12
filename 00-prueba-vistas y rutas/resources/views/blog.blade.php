@extends('layouts.app')

@section('meta-description', "Meta de Blog")
@section('title', "Blog")

@section('content')
    <h1>Contacto</h1>
    <p>Si ejecuto código directamente con <.?php .......... ?> alguien puede inyectar código</p>
    <p>Pero si utilizamos { { lo que hay dentro se interpreta como string } } {{'<script>alert("esto es inyección de código de terceros")</script>' }}</p>
    <p>si se usa { !! ''código que se ejecuta pero no hay protección'' !! } si se ejecuta</p>
    <p>{!!"<script>alert('esto es inyección de código de terceros')</script>"!!} </p>

    <h3>Mirar la vista compilada</h3>
    <p>Si accedemos a la ruta storage>views>2466gar(alearotio) -> vermos la vista compilada a interpretar por el html y php</p>
    <pre>ejemplo '< a href="< ?php echo e(route('blog')); ? >">Blog < / a>
    </pre>
@endsection
