<h5 class="border border-black bg-lime-500 pl-2 mx-1" id="gasto">ESTADO DE CUENTAS</h5>
<div class="border border-black rounded-b-lg mx-2 px-2">

    <p>
        @foreach ($listapagos as $item => $pago)
            <span class="bg-yellow-300 rounded-full px-2">@-{{$pago['alias']}} </span class="text-sky-600"><span>({{$pago['pagado']}}/{{session('mediaPagos')}}€) </span>
        @endforeach
    </p>
    
    <div class="flex mt-4">
        <div class="w-1/2">
            <h5>USUARIOS QUE DEBEN A USUARIOS</h5>
            @foreach ($deben as $item => $debe)
                    <p>{{$debe}}</p>
                    @if ($listapagos[$item]['pagado'] > session('mediaPagos') && session('pagado') < session('mediaPagos') && !str_contains($debe, "no debe ni le deben dinero"))
                        <form action="{{e(route('gasto.vista.pago.usuario'))}}" method="post">
                            @csrf
                            <input type="hidden" name="usuario_id" value="{{$listapagos[$item]['usuario_id']}}">
                            <input type="hidden" name="alias" value="{{$listapagos[$item]['alias']}}">
                            <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                            <input type="hidden" name="costeMax" value="{{$listapagos[$item]['pagado'] - session('mediaPagos')}}">
                            <button class="basis-1/4 h-10 mr-1 col-span-1 border border-black rounded-md bg-blue-500" type="submit">realizar pago</button>
                        </form>
                    @endif
            @endforeach

        </div>
        <div class="w-1/2">
            <h5>GASTOS GENERALES</h5>
        </div>
    </div>
</div>