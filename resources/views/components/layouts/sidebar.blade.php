<header class="fixed w-full flex items-center justify-between h-10 z-10 bg-gradient-to-r from-blue-700 to-blue-500 shadow-sm shadow-blue-700">
        
        <h1> <a href="{{e(route('inicio'))}}"><img src="{{asset('images/logo_prueba5.png')}}" alt="" class="h-10"></a></h1>
        <div class="grid justify-end mr-3">
                <a class="bg-yellow-300 rounded-full px-2" href="{{ e(route('ajustes')) }}">@-{{session('alias')}}</a>
        </div>
                
        
</header>
<aside id="main-menu">
        
        <x-layouts.navegacion/>
        
</aside>
