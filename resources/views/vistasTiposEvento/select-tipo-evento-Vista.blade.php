<x-layouts.base titulo="Evento" metaDescription="Admin Evento sin presupuesto Plandyapp">

    <h2>Seleccion el tipo de evento que deseas crear</h2>

        <p>Si creas un evento sin presupuesto,no podrás hacer presupuestos pero es
            una buena idea para viajes improvisados
        </p>
        <a class="border border-black rounded-md bg-yellow-400 py-1 p-2 my-2 mx-2" href="{{route('evento.crear', 'sin-presupuesto')}}">Evento Sin Presupuesto</a>
        <p>Si creas un evento con presupuesto podrás hacer presupuestos, ideal para viajes
            en grupo que te permite hacerle ver a los demás participantes el coste aproximado
            del evento
        </p>
        <a class="border border-black rounded-md bg-orange-600 py-1 p-2 my-2 mx-2" href="{{route('evento.crear', 'con-presupuesto')}}">Evento Con Presupuesto</a>
    
</x-layouts.base>