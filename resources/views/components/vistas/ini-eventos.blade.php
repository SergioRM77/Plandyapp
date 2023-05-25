<article>
    <h3 class="rounded-md shadow-lg bg-gradient-to-r from-green-500 to-green-700  border border-green-800 text-lg pl-4">EVENTOS ACTIVOS</h3>
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
        <h3 class="rounded-md shadow-lg bg-gradient-to-r from-cyan-500 to-blue-500  border border-blue-800 text-lg pl-4">EVENTOS FINALIZADOS</h3>
        @if ($eventos != null)
            @foreach ($eventos as $item => $evento)
                @if (!$evento["is_activo"])
                    <section class="px-4 py-1">
                        <x-vistas.vistaBaseEvento :evento="$evento"/>
                    </section>
                @endif
            @endforeach
        @else
            <p>No hay eventos Finalizados </p>
        @endif
        
</article>