<nav class="fixed h-full from-gray-200 to-gray-400 mt-10 overflow-hidden w-14 hover:w-52 group border-r-2 border-gray-200 ease-in-out duration-300" id="main-menu">

        <div class="relative bg-gradient-to-r bg-gray-200  h-full p-3 shadow-lg">
            <div class="grid place-items-center space-x-4 ml-10 mb-2 group-hover:ml-4">
                <img class="object-cover h-24 w-24 ml-4 rounded-full"  src="{{session('foto_perfil') != null ? asset(session('foto_perfil')) :
                        'https://img2.freepng.es/20190221/gw/kisspng-computer-icons-user-profile-clip-art-portable-netw-c-svg-png-icon-free-download-389-86-onlineweb-5c6f7efd8fecb7.6156919015508108775895.jpg'}}" name="foto" alt="foto perfil">
                    <h4 class="font-semibold text-lg text-gray-700 font-poppins tracking-wide w-28">
                        <a href="{{ e(route('ajustes')) }}">@-{{session('alias')}}</a>
                    </h4>
            </div>
            <ul class="text-sm">
                <li class="w-48">
                    <a href="{{ e(route('contactos.miscontactos')) }}" class="flex items-center space-x-3 py-2 text-gray-700  rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-people-fill"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/uukerzzv.json"
                            trigger="hover">
                        </lord-icon>
                        <span>Lista Contactos</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-calendar2-plus-fill"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/fpmskzsv.json"
                            trigger="hover">
                        </lord-icon>
                        <span>Ver Evento</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('inicio')) }}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-calendar-event"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/xhcrhqyw.json"
                            trigger="hover">
                        </lord-icon>
                        <span>Ver Evento Finalizado</span>
                    </a>
                </li>
                <li class="w-48">
                    {{-- <a href="{{e(route('evento.select.tipo'))}}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline"> --}}
                        {{-- <i class="bi-plus-circle-fill"></i> --}}
                    <div class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        <lord-icon
                            src="https://cdn.lordicon.com/mecwbjnp.json"
                            trigger="hover"
                            colors="primary:#121331,secondary:#000000">
                        </lord-icon>
                        <label for="tipo-evento-modal" class="cursor-pointer">Crear Evento</label>
                    </div>
                    {{-- </a> --}}
                </li>
                <li class="w-48">
                    <a href="{{ e(route('mensajeria')) }}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-envelope-fill"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/psnhyobz.json"
                            trigger="hover">
                        </lord-icon>
                        <span>Mensajería</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('ajustes')) }}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-gear-fill"></i> --}}
                        <lord-icon
                        src="https://cdn.lordicon.com/hwuyodym.json"
                        trigger="hover">
                    </lord-icon>
                        <span>Ajustes</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{ e(route('acercade')) }}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-exclamation-circle"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/dnmvmpfk.json"
                            trigger="hover">
                        </lord-icon>
                        <span>Acerca de ...</span>
                    </a>
                </li>
                <li class="w-48">
                    <a href="{{e(route('logout'))}}" class="flex items-center space-x-3 text-gray-700 py-2 rounded-md font-medium hover:bg-sky-50 focus:bg-gray-200 focus:shadow-outline">
                        {{-- <i class="bi-box-arrow-right"></i> --}}
                        <lord-icon
                            src="https://cdn.lordicon.com/moscwhoj.json"
                            trigger="hover"
                            colors="primary:#000000,secondary:#08a88a">
                        </lord-icon>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>
                
            </ul>
        </div>
</nav>


