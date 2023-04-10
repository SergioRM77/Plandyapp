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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
<body>
    <x-layouts.sidebar/>
    <hr>
    @if (session('status'))
        <div class="mt-10">
            {{session('status')}}
        </div>
    @endif
    <main class="md:container md:w-3/4 md:my-10 m-3 mt-8">
        {{$slot}}
    </main>
    {{-- <label for="my-modal-4" class="btn ml-44">Modal que desaparece pinchando fuera</label>
    <label for="my-modal-3" class="btn">Modal que desaparece pinchado x</label>
    <label for="my-modal" class="btn">Modal que desaparece pinchando ok</label> --}}
    <x-layouts.footer/>
    



{{-- <!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
  <div class="modal-box bg-amber-400">
    <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
        
    <p class="py-4">texto</p>
    <div class="modal-action">
      <label for="my-modal" class="btn">ok!</label>
    </div>
  </div>
</div>
<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-3" class="modal-toggle" />
<div class="modal ">
  <div class="modal-box relative bg-amber-400">
    <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
    <h3 class="text-lg font-bold">Congratulations random Internet user!</h3>
    <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p> 
  </div>
</div>

<input type="checkbox" id="my-modal-4" class="modal-toggle w-full" />
<label for="my-modal-4" class="modal cursor-pointer">
  <label class="modal-box relative bg-amber-400" for="">
    <img class="object-cover h-24 w-24 rounded-full"  src="{{session('foto_perfil') != null ? asset(session('foto_perfil')) :
                        'https://img2.freepng.es/20190221/gw/kisspng-computer-icons-user-profile-clip-art-portable-netw-c-svg-png-icon-free-download-389-86-onlineweb-5c6f7efd8fecb7.6156919015508108775895.jpg'}}" name="foto" alt="foto perfil">
    <p class="py-4">Texto</p> --}}
  </label>
</label> 
</body> 
</html>