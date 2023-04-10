<article>
    <h3 class="bg-green-500 border-2 border-black">EVENTOS ACTIVOS</h3>
    @if ($eventos != null)
        @foreach ($eventos as $item => $evento)
            @if ($evento["is_activo"])
                <section class="px-4 py-1">
                    <x-vistas.vistaBaseEvento :evento="$evento"/>
                </section>
            @endif
        @endforeach
    @else
        <h4>No hay eventos activos</h4>
    @endif
    
</article>
<hr>
<article>
        <h3 class="bg-blue-500 border-2 border-black">EVENTOS FINALIZADOS</h3>
        @if ($eventos != null)
            @foreach ($eventos as $item => $evento)
                @if (!$evento["is_activo"])
                    <section class="px-4 py-1">
                        <x-vistas.vistaBaseEvento :evento="$evento"/>
                    </section>
                @endif
            @endforeach
        @endif
        @if ($numEventosFinalizados[0]->numFinalizados == 0)
            <p>No hay eventos Finalizados </p>
        @endif
</article>