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

</body> 
</html>