<div class="flex items-center border border-black bg-lime-500 pl-2 py-1 rounded-md mt-2" id="cuentas">
    <div id="desplegable-cuentas" class="triangulo_inf"></div>
    <h5 class="ml-2">ESTADO DE CUENTAS:</h5>
</div>

<div class="border border-black rounded-b-lg mx-2 px-2" id="datos-cuentas">

    <p>
        @foreach ($listapagos as $item => $pago)
            <span class="bg-yellow-300 rounded-full px-2">@-{{$pago['alias']}} </span class="text-sky-600"><span>({{$pago['pagado']}}/{{session('mediaPagos')}}€) </span>
        @endforeach
    </p>
    
    <div class="flex mt-4">
        <div class="">
            <h5>USUARIOS QUE DEBEN A USUARIOS</h5>
            @foreach ($deben as $item => $debe)
                    <p class="{{str_contains($debe, "ha pagado de más") ? 'font-bold' : ''}}">{{$debe}}</p>
                    @if ($listapagos[$item]['pagado'] > session('mediaPagos') && session('pagado') < session('mediaPagos') 
                        && !str_contains($debe, "no debe ni le deben dinero") && session('is_activo'))
                        <form action="{{e(route('gasto.vista.pago.usuario'))}}" method="post">
                            @csrf
                            <input type="hidden" name="usuario_id" value="{{$listapagos[$item]['usuario_id']}}">
                            <input type="hidden" name="alias" value="{{$listapagos[$item]['alias']}}">
                            <input type="hidden" name="evento_id" value="{{session('evento_id')}}">
                            <input type="hidden" name="costeMax" value="{{$listapagos[$item]['pagado'] - session('mediaPagos')}}">
                            <button class="btn bg-blue-500 hover:bg-blue-600 hover:text-white p-2 my-2 mx-2" type="submit">realizar pago</button>
                        </form>
                    @endif
            @endforeach

        </div>
        
    </div>
</div>