<nav class="fixed h-full border border-sky-500 mt-10 overflow-hidden w-12 hover:w-52 group" id="main-menu">


        <div class="relative bg-slate-400 h-full p-3 shadow-lg">
            <div class="grid place-items-center space-x-4 ml-10 mb-2 group-hover:ml-0">
                <img class="object-cover h-24 w-24 rounded-full"  src="{{session('foto_perfil') != null ? asset(session('foto_perfil')) :
                        'https://img2.freepng.es/20190221/gw/kisspng-computer-icons-user-profile-clip-art-portable-netw-c-svg-png-icon-free-download-389-86-onlineweb-5c6f7efd8fecb7.6156919015508108775895.jpg'}}" name="foto" alt="foto perfil">
                    <h4 class="font-semibold text-lg text-gray-700 capitalize font-poppins tracking-wide">
                        <a href="{{ e(route('ajustes')) }}">@-{{session('alias')}}</a>
                    </h4>
            </div>
            <ul class="space-y-2 text-sm">
                <li class="w-48">
                    <a href="{{ e(route('contactos.miscontactos')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-people-fill"></i>
                        <span>Lista Contactos</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-calendar2-plus-fill"></i>
                        <span>Ver Evento</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-calendar-event"></i>
                        <span>Ver Evento Finalizado</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{e(route('evento.select.tipo'))}}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-plus-circle-fill"></i>
                        <span>Crear Evento</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('mensajeria')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-envelope-fill"></i>
                        <span>Mensajería</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('ajustes')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-gear-fill"></i>
                        <span>Ajustes</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('acercade')) }}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-exclamation-circle"></i>
                        <span>Acerca de ...</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{e(route('logout'))}}" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline">
                        <i class="bi-box-arrow-right"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
                
            </ul>
        </div>
</nav>


