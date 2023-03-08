<nav class="fixed h-full border border-sky-500 mt-10" id="main-menu">


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
                    <a href="{{ e(route('contactos.miscontactos')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-people-fill"></i>
                        <span>Lista Contactos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-calendar2-plus-fill"></i>
                        <span>Ver Evento</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-calendar-event"></i>
                        <span>Ver Evento Finalizado</span>
                    </a>
                </li>
                <li>
                    <a href="{{e(route('evento.crear.sin'))}}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-plus-circle-fill"></i>
                        <span>Crear Evento</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('mensajeria')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-envelope-fill"></i>
                        <span>Mensajería</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('ajustes')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-gear-fill"></i>
                        <span>Ajustes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ e(route('acercade')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-exclamation-circle"></i>
                        <span>Acerca de ...</span>
                    </a>
                </li>
                <li>
                    <a href="{{e(route('logout'))}}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-box-arrow-right"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
                
            </ul>
        </div>
</nav>


