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
    {{-- <label for="my-modal-4" class="btn ml-44">Modal que desaparece pinchando fuera</label>
    <label for="my-modal-3" class="btn">Modal que desaparece pinchado x</label>
    <label for="my-modal" class="btn">Modal que desaparece pinchando ok</label> --}}
    <!-- The button to open modal -->
{{-- <label for="my-modal-5" class="btn">open modal</label>
    <x-layouts.footer/>
     --}}


{{-- 
<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-5" class="modal-toggle" />
<div class="modal">

    <div class="presentar gasto">
      
        <h4 class="border border-black bg-blue-600 pl-2">PRESENTAR GASTO:</h4> 
        <form class="border border-black  mx-2 px-2 bg-amber-100" action="" method="post" enctype="multipart/form-data">
            @csrf
            @if (session('error_gasto'))<p class="w-full"></p>@endif
            <input type="hidden" name="evento_id" value="">
            <label class="font-semibold">Gasto de:<span class="bg-yellow-300 rounded-full px-2">@-</span></label>

            <div class="grid grid-cols-3">
                <div class="grid grid-cols-1">
                    
                    <label class="col-span-1 row-span-3 font-semibold" for="coste">Coste:
                        <input class="col-span-2 border border-blue-400 rounded-md my-4" type="number" name="coste" value="0" step="any"></label>

                    <label class="col-span-1 row-span-2 font-semibold">Descripcion del gasto:
                        <textarea class="col-span-2 border border-blue-400 rounded-md mt-4" name="descripcion" id="" cols="30" rows="3"></textarea></label>

                </div>
                <div class="grid grid-cols-1">

                </div>
                <div class="grid grid-cols-1 justify-items-center items-center">
                    <input class="border-2 border-blue-800 border-dashed rounded-md bg-blue-400 px-6 py-6" type="file" name="foto" value="Subir foto" accept="image/*">
                </div>
            </div>

            <div class="flex flex-row justify-center my-4">
              
                <input class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit" value="Subir">
                <label for="my-modal-5" class="btn basis-1/4 h-10 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border border-black rounded-md bg-red-500">Yay!</label>
            </div>
        </form>
    </div>

    </div>
  </div>
</div> --}}

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
    <p class="py-4">Texto</p> 
  </label>
</label>  --}}
</body> 
</html>