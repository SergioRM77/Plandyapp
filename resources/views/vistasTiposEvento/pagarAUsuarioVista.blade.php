<x-layouts.base titulo="Evento Finalizado" metaDescription="Evento Finalizado Plandyapp">

    <h2>Pagar a otro Usuario</h2>
    <div class="presentar gasto">
        <h4 class="border border-black bg-violet-400 pl-2">Pagar a usuario parte de lo que se le debe</h4> 
        <form class="border border-black  mx-2 px-2" action="{{e(route('gasto.pago.usuario'))}}" method="post">
            @csrf
            <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
            <input type="hidden" name="alias" value="{{$request->alias}}">
            <input type="hidden" name="usuario_id" value="{{$request->usuario_id}}">
            <label class="font-semibold">Pago de: <span class="bg-yellow-300 rounded-full px-2">@-{{session('alias')}}</span> para otro usuario: <span class="bg-yellow-300 rounded-full px-2">@-{{$request->alias}}</span></label>

            <div class="grid grid-cols-3">
                <div class="grid grid-cols-1">
                    <label class="col-span-1 row-span-3 font-semibold" for="coste">Tu pago máximo para este usuario es de {{session('mediaPagos') - session('pagado')}}€:
                        <input class="col-span-2 border border-blue-400 rounded-md my-4" type="number" name="coste" value="{{session('mediaPagos') - session('pagado')}}" min="0" max="{{session('mediaPagos') - session('pagado')}}" step="any"></label>
                    <p class="col-span-1 row-span-2 font-semibold">Descripcion del gasto: @-{{$request->alias}} ha recibido un pago de @-{{session('alias')}}</p>
                </div>
                <div class="grid grid-cols-1">

                </div>
                <div class="grid grid-cols-1 justify-items-center items-center">
                    <input class="border-2 border-blue-800 border-dashed rounded-md bg-blue-400 px-6 py-4" type="image" value="Subir foto">
                </div>
            </div>

            <div class="flex flex-row justify-center my-4">
                <input class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-green-500" type="submit" value="Subir">
                <a class="basis-1/4 h-10 pt-2.5 ml-1 col-span-1 inline-block align-middle text-center border border-black rounded-md bg-red-500" href="{{e(route('evento.ver.get', session('evento_id')))}}">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.base>