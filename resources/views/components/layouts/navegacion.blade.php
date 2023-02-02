<nav class="fixed h-full z-10 border border-sky-500 {{$visible}}">


        <div class="bg-slate-400 h-full p-3 shadow-lg">
            <div class="flex items-center space-x-4 p-2 mb-5">
                <img class="h-10 rounded-full" src="https://www.videogameschronicle.com/files/2022/05/star-wars-jedi-survivor-1.jpg" alt="@-{{session('alias')}}">
                <div>
                    <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">
                        <a href="{{ e(route('ajustes')) }}">@-{{session('alias')}}</a>
                    </h4>
                </div>
            </div>
            <ul class="space-y-2 text-sm">
                <li>
                    <a href="{{ e(route('contactos')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Lista Contactos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Ver Evento</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Ver Evento Finalizado</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Crear Evento</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('mensajeria')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Mensajería</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('ajustes')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Ajustes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('acercade')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Acerca de ...</span>
                    </a>
                </li>
                <li>
                    <a href="{{e(route('logout'))}}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
                
            </ul>
        </div>
</nav>


