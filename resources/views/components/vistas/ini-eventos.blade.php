<article>
    <h3 class="bg-green-500 border-2 border-black">EVENTOS ACTIVOS</h3>
    @if ($eventos != null)
        @foreach ($eventos as $item => $evento)
            <section class="px-4 py-1">
                <x-vistas.vistaBaseEvento :evento="$evento"/>
            </section>
        @endforeach
    @else
        <h4>No hay eventos activos</h4>
    @endif
    
</article>
<hr>
<article>
        <h3 class="bg-blue-500 border-2 border-black">EVENTOS FINALIZADOS</h3>
        {{-- <section class="px-4 py-1">
            <x-vistas.vistaBaseEvento/>
        </section> --}}
</article>