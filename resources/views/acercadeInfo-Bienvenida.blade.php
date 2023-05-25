<x-layouts.base-no-login>
    <main class="md:container md:w-3/4">
        <article class="py-14">
            <x-vistas.acercadeInfo-comp/>
            <div class="pt-4 flex justify-center">
                <p class="bg-blue-400 w-40 text-center rounded-md border hover:bg-blue-600 hover:border-black">
                    <a href="{{route('login')}}" class="font-mono hover:underline hover:font-bold">Volver a Login</a>
                </p>
                
            </div>
            
        </article>
    </main>
    
</x-layouts.base-no-login>