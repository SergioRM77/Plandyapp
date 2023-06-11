<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PlandyApp - {{$titulo ?? ""}}</title>
    <meta content="{{$metaDescription ?? 'Aplicacion de gestion de viajes Plandyapp'}}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/sidebar.css' rel='stylesheet'>
</head>
<body class="scrollbar scrollbar-thumb-gray-400 scrollbar-thumb-rounded-sm">
    <x-layouts.sidebar/>
    <hr>
    
    <main class="md:container md:w-3/4 md:my-10 m-3 mt-8">
        @if (session('status'))
          <div class="flex justify-center">
            <div class="alert shadow-lg bg-blue-50 sm:w-2/4 border border-blue-300">
                <p>{{session('status')}}</p>
            </div>
          </div>
      @endif
      
      
        {{$slot}}
         
    </main>

<input type="checkbox" id="tipo-evento-modal" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
  <div class="modal-box bg-orange-50">
    <h3 class="font-bold text-lg">Seleccion el tipo de evento que deseas crear</h3>
    <p class="py-4">Si creas un evento <span class="font-bold">SIN PRESUPUESTO</span>, no podrás hacer presupuestos pero es
        una buena idea para viajes improvisados</p>
        <a class="btn bg-yellow-300 hover:bg-yellow-500" href="{{route('evento.crear', 'sin-presupuesto')}}">Evento Sin Presupuesto</a>
        <p class="py-4">Si creas un evento <span class="font-bold">CON PRESUPUESTO</span> podrás hacer presupuestos, ideal para viajes
            en grupo que te permite hacerle ver a los demás participantes el coste aproximado
            del evento</p>
            <a class="btn bg-orange-500 hover:bg-orange-700 hover:text-white" href="{{route('evento.crear', 'con-presupuesto')}}">Evento Con Presupuesto</a>
    <div class="modal-action">
      <label for="tipo-evento-modal" class="btn bg-red-500 hover:bg-red-700 hover:text-white">Cancelar</label>
    </div>
  </div>
</div>

</body> 
</html>