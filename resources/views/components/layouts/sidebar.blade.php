<header class="fixed w-full bg-blue-700 z-10">
        <div class="columns-2">
                <h1 class="ml-3"> <a href="{{e(route('inicio'))}}">Logo Plandyapp</a></h1>
                <div class="grid justify-end mr-3">
                        <a class=" bg-yellow-300 rounded-full" href="{{ e(route('ajustes')) }}">@-{{session('alias')}}</a></div>
                </div>
        <x-layouts.navegacion visible="visible"/>
</header>