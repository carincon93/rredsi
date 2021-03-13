@php
    $authUser = Auth::user();

    $node                           = null;
    $educationalInstitution         = null;
    $educationalInstitutionFaculty  = null;
    $researchGroup                  = null;

     /**
      * Explorer
     * Traemos la informacion de el nodo directamente del usuario
     * llegado al caso que haya error se trae de la ruta
     * luego validamos si es diferente a null para que no nos muestre error
     */
    $educationalInstitutionFaculty = $authUser->educationalInstitutionFaculties()->where('is_principal', 1)->first();
    if ( $educationalInstitutionFaculty ) {
        $node = $educationalInstitutionFaculty->educationalInstitution->node;
    } else {
        $node = request()->route('node');
    }

    if ( $authUser->hasRole(3) ) {
        $node                   = $authUser->isEducationalInstitutionAdmin->node;
        $educationalInstitution = $authUser->isEducationalInstitutionAdmin;
    }

    if ( $authUser->hasRole(4) ) {
        /**
        * Traemos la informacion del nodo de la institucion y facultad para los enlaces de redireccion
        * para Mis proyectos de estudiantes
        */
        if ( !is_null($user->my_projects ) ) {
            $node                             = $user->my_projects['node'];
            $educationalInstitution           = $user->my_projects['educationalInstitution'];
            $educationalInstitutionFaculty    = $user->my_projects['educationalInstitutionFaculty'];
            $researchGroup                    = $user->my_projects['researchGroup'];
            $researchTeam                     = $user->my_projects['researchTeam'];
        }
    }

    /**
     * Trear id de nodo, facultad, e institucion si estas existen en la uri
    */
    if ( request()->route('node') ) {
        $node = request()->route('node');
    }

    if ( request()->route('educational_institution') ) {
        $educationalInstitution = request()->route('educational_institution');
    }

    if ( request()->route('faculty') ) {
        $educationalInstitutionFaculty = request()->route('faculty');
    }

    $count = $authUser->unreadNotifications->count();

@endphp

<style>
    /* width */
    ::-webkit-scrollbar {
      width: 16px;
      height: 16px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      border-radius: 100vh;
      background: #edf2f7;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #cbd5e0;
      border-radius: 100vh;
      border: 3px solid #edf2f7;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #a0aec0;
    }

    .scroll {
        overflow-y: hidden;
    }

    .scroll:hover {
        vertical-align: bottom;
        overflow: auto;
    }

</style>

<div class="md:overflow-hidden md:h-32 w-1/2 md:w-1/3 lg:w-64 md:flex fixed flex-col md:flex-row md:min-h-screen w-full bg-gray-100 border-r z-30">
    <div @click.away="open = false" class="flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }">
      {{-- logosidebar --}}
        <div class="animate-pulse h-16 border-b items-center mb-2 flex  md:justify-center ">
            <button class="pl-3 md:pl-0 rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline l-0" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            @if ( $node && $authUser->hasRole(2) )
                <a class="m-auto pl-14 md:pl-0 md:pr-0 md:justify-center py-3" href="{{ route('nodes.dashboard', [$node]) }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            @elseif ( $node && $authUser->hasRole(3) )
                <a class="m-auto pl-14 md:pl-0 md:pr-0 md:justify-center py-3" href="{{ route('nodes.educational-institutions.dashboard', [$node, $authUser->isEducationalInstitutionAdmin->id]) }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            @endif

            {{-- Logout//salir --}}
            <div class="block md:hidden mt-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="flex justify-end">
                        <div class="block">
                            <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Logout') }}
                                <svg class="inline-block p-0 m-0 h-6 w-6 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </x-jet-dropdown-link>
                        </div>
                    </div>

                </form>
            </div>

        </div>
        {{-- links_sidebar --}}
        <nav :class="{'block': open, 'hidden': !open}" class="scroll flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
            {{-- Administrar perfil en dispositivo movil --}}
            <div class="block overflow-auto md:hidden mt-1">
            {{-- <x-drop-down-profile /> --}}
                <p class="text-center mx-auto capitalize p-0 m-0">{{ $authUser->name }}</p>
                @can('show_profile')
                <a href="{{ route('profile.show') }}" class="block">
                    <svg class="inline p-0 m-0 h-5 w-6 ml-2 mr-2 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('Profile') }}
                </a>
                @endcan
                @can('index_graduation')
                <a href="{{ route('user.profile.user-graduations.index') }}" class="mt-2 block">
                    <svg  class="inline p-0 m-0 h-5 w-6 ml-2 mr-2 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" /><path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    {{ __('Graduations') }}
                </a>
                @endcan
            </div>

            {{-- Notificacion movil --}}
            @can('index_notification')
            <div class="block md:hidden mt-2">
                <a href="{{ route('notifications.index') }}" class="text-gray-600 hover:text-gray-400">
                    <svg class="inline p-0 m-0 h-5 w-6 ml-2 mr-2 mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="inline-block text-gray-700">{{ __('Notifications') }}</span>
                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                        {{$count}}
                    </span>
                </a>
            </div>
            @endcan

            @if( $node )
                <div class="block md:hidden mt-2">
                    <a href="{{ route('nodes.explorer', [$node]) }}" class="text-gray-600 hover:text-gray-400 mb-3">
                        <svg class="inline p-0 m-0 h-4 w-6 ml-2 mr-2 mb-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)"/>
                        </svg>
                        {{ __('Explorer') }}
                    </a>
                </div>

                @if( $authUser->hasRole(4) && $educationalInstitution && $educationalInstitutionFaculty && $researchGroup && $researchTeam)
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects',[$node, $educationalInstitution, $educationalInstitutionFaculty, $researchGroup, $researchTeam]) }}" class="text-gray-600 hover:text-gray-400 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                        {{ __('my projects') }}
                    </a>
                    <hr>
                @endif
            @endif

            {{-- dropdown que  que puede visualizar el admin del sistema --}}
            @can('index_user')
            <a href="{{ route('users.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Users') }}</span>
            </a>
            @endcan
            @can('index_role')
            <a href="{{ route('roles.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Roles') }}</span>
            </a>
            @endcan
            @can('index_nodes')
            <a href="{{ route('nodes.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Nodes') }}</span>
            </a>
            @endcan
            @can('index_knowledge_area')
            <a href="{{ route('knowledge-areas.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Knowledge areas') }}</span>
            </a>
            @endcan
            @can('index_knowledge_subarea')
            <a href="{{ route('knowledge-subareas.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Knowledge subareas') }}</span>
            </a>
            @endcan
            @can('index_knowledge_subarea_discipline')
            <a href="{{ route('knowledge-subarea-disciplines.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Knowledge subarea disciplines') }}</span>
            </a>
            @endcan
            @can('index_legal_information')
            <a href="{{ route('legal-informations.index') }}" class="w-full flex items-center  md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-700">{{ __('Legal informations') }}</span>
            </a>
            @endcan

            {{-- dropdown que  que puede visualizar el coordinador de cada nodo--}}
            @if ($node)
                @if( $authUser->hasRole(2) )
                    <div @click.away="open = false" class="static" x-data="{ open: false }">
                        <button @click="open = !open" class="flex flex-row items-center justify-between w-full py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <span class="capitalize">Nodo {{ $node->state }}</span>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg z-10">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                <a href="{{ route('nodes.dashboard', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Dashboard') }}</span>
                                </a>

                                <a href="{{ route('nodes.events.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Node events') }}</span>
                                </a>
                                @can('index_annual_node_event')
                                <a href="{{ route('annualNodeEvent.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Annual node events') }}</span>
                                </a>
                                @endcan
                                @can('index_educational_institution')
                                <a href="{{ route('nodes.educational-institutions.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Educational institutions') }}</span>
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- dropdown que  puede visualizar el delegado de cada institucion
                y administrar sus dependencias--}}
            @if( $authUser->hasRole(3) )
                @if ( $educationalInstitution )
                    <div>
                        {{-- dropdown ini --}}
                        <x-drop-down-educational-institution />
                    </div>

                    <hr class="mt-4 mb-4">

                    <a href="{{ route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution]) }}" id="faculties" class="mt-4 mb-4 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">{{ __('Faculties') }}</span>
                    </a>

                    @if ($node && $educationalInstitutionFaculty)
                        <hr class="mt-4 mb-4">
                        <p class="mt-4 mb-4 text-center"><strong>{{ $educationalInstitutionFaculty->name }}</strong></p>
                        @can('index_academic_program')
                        <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="academic_programs" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">{{ __('Academic programs') }}</span>
                        </a>
                        @endcan
                        @can('index_research_group')
                        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="research_groups" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">{{ __('Research groups') }}</span>
                        </a>
                        @endcan
                        @can('index_educational_environment')
                        <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="educational_environments" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">{{ __('Educational environments') }}</span>
                        </a>
                        @endcan
                        @can('index_educational_institution_user')
                        <a href="{{ route('nodes.educational-institutions.faculties.users.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="users" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1" style="width: 18px;">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-700">{{ __('Users') }}</span>
                        </a>
                        @endcan
                    @endif
                @endif
            @endif

            {{-- dropdown component para administrar datos de cada facultad --}}
            @if( !Auth::user()->hasRole(4) )
                {{-- <x-drop-down-educational-institution-faculties /> --}}
            @endif

            {{-- dropdown ini --}}
            {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                <span>Dropdown</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg z-10">
                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
                </div>
                </div>
            </div> --}}
        </nav>
    </div>
</div>
