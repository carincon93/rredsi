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
        * Traemos los semilleros a los que pertenece el estudiante
        */
        $authUserResearchTeams = $authUser->researchTeams()->get() ?? null;
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

@push('styles')
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
@endpush

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

            <a class="m-auto pl-14 md:pl-0 md:pr-0 md:justify-center py-3" href="#">
                <x-jet-application-mark class="block h-9 w-auto" />
            </a>

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
        <nav :class="{'block': open, 'hidden': !open}" class="scroll flex-grow md:block pb-4 md:pb-0 md:overflow-y-auto">
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
            @endif

            <a href="{{ route('dashboard') }}" class="w-full flex items-center md:mt-1/6 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg"class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 32 32">
                    <g >
                      <rect width="32" height="32" fill="none"/>
                      <path d="M406-333.194h8.645V-344H406v10.806Zm0,8.645h8.645v-6.484H406v6.484Zm10.806,0h8.645v-10.806h-8.645v10.806Zm0-19.452v6.484h8.645V-344Z" transform="translate(-399.516 350.484)" fill-rule="evenodd"/>
                    </g>
                  </svg>

                <span class="text-gray-700">{{ __('Dashboard') }}</span>
            </a>

            <hr class="mb-1/6 mt-1/6">

            @if( $authUser->hasRole(4))

                <a href="{{ route('notifications.indexRequestStudent') }}" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-gray-700">{{ __('Solicitudes realizadas') }}</span>
                </a>

                <p class="bg-gray-100 p-4 text-center"><strong>Semilleros de investigación a los que pertenezco</strong></p>

                @foreach ($authUserResearchTeams as $authUserResearchTeam)
                <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.index',[$authUserResearchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->node, $authUserResearchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution, $authUserResearchTeam->researchGroup->educationalInstitutionFaculty, $authUserResearchTeam->researchGroup]) }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 26 23.116">
                        <path d="M24.709.415A.7.7,0,0,0,23.432.361a7.741,7.741,0,0,1-6.767,3.95H13.053a8.67,8.67,0,0,0-8.667,8.667,8.926,8.926,0,0,0,.068.925,21.6,21.6,0,0,1,12.934-3.815.722.722,0,0,1,0,1.445C6.038,11.534,1.226,18.491.161,21.1a1.447,1.447,0,0,0,2.677,1.1,11.877,11.877,0,0,1,3.246-4.09,8.648,8.648,0,0,0,7.9,3.485c7.087-.515,12.076-6.871,12.076-14.653A16.416,16.416,0,0,0,24.709.415Z" transform="translate(-0.055 0.024)"/>
                    </svg>
                    <span class="text-gray-700">{{ $authUserResearchTeam->name }}</span>
                </a>
                @endforeach
            @endif

            {{-- dropdown que  que puede visualizar el admin del sistema --}}
            @can('index_user')
            <a href="{{ route('users.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-gray-700">{{ __('Users') }}</span>
            </a>
            @endcan
            @can('index_role')
            <a href="{{ route('roles.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 26.233 25.233">
                    <g transform="translate(-1197 -1921)">
                      <path d="M16,7a4,4,0,1,1-4-4A4,4,0,0,1,16,7Zm-4,7a7,7,0,0,0-7,7H19a7,7,0,0,0-7-7Z" transform="translate(1193 1919)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                      <g transform="translate(1205 1928)">
                        <path d="M8.792,4.041a1.363,1.363,0,0,1,2.649,0,1.363,1.363,0,0,0,2.035.843A1.364,1.364,0,0,1,15.35,6.758a1.363,1.363,0,0,0,.842,2.034,1.363,1.363,0,0,1,0,2.649,1.363,1.363,0,0,0-.843,2.035,1.364,1.364,0,0,1-1.874,1.874,1.363,1.363,0,0,0-2.034.842,1.363,1.363,0,0,1-2.649,0,1.363,1.363,0,0,0-2.035-.843,1.364,1.364,0,0,1-1.874-1.874,1.363,1.363,0,0,0-.842-2.034,1.363,1.363,0,0,1,0-2.649,1.363,1.363,0,0,0,.843-2.035A1.364,1.364,0,0,1,6.758,4.884a1.363,1.363,0,0,0,2.034-.842Z" fill="#fff" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        <path d="M13.744,11.372A2.372,2.372,0,1,1,11.372,9,2.372,2.372,0,0,1,13.744,11.372Z" transform="translate(-1.256 -1.256)" fill="#fff" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                      </g>
                    </g>
                </svg>
                <span class="text-gray-700">{{ __('Roles') }}</span>
            </a>
            @endcan
            @can('index_nodes')
            <a href="{{ route('nodes.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 19.004 24.697">
                    <g transform="translate(0 0)">
                      <g transform="translate(0 0)">
                        <path d="M0,17.74l.788-.465c-.239-.853-.149-1.008.722-1.327a1.36,1.36,0,0,0,.571-.5,6.251,6.251,0,0,0,.468-.892c.071-.149.208-.425.174-.446C1.8,13.422,2.633,12.326,2.1,11.5c-.239-.367,0-1.049.03-1.618a2.427,2.427,0,0,1-.56-.513c-.242-.429-.81-.863.189-1.236.477-.177.446-.855.1-1.416l1.054.78-.266-.859,1.8-1.824a1.894,1.894,0,0,1,.88-2.219c.217-.134.586-.019,1-.019a.419.419,0,0,1,.114-.257c.138-.149.357-.364.508-.34a1.449,1.449,0,0,0,1.323-.435,13.515,13.515,0,0,1,1.942-1.5c.2-.125.594.067.892.114-.131.218-.22.563-.4.635-.935.352-1.352,1.234-1.983,1.884-.22.229-.2.706-.256,1.073s-.08.752-.12,1.15a2.3,2.3,0,0,1,1.32,1.88,1.2,1.2,0,0,0,1.323,1.278c.45-.031.905-.217,1.351-.211s1.115.015,1.314.3c.676.923,1.52.774,2.4.626.383-.065.756-.195,1.141-.247.531-.071.652.165.476.679a5.425,5.425,0,0,0-.413,1.718,3.181,3.181,0,0,0,.531,1.286,3.715,3.715,0,0,0,.476.594l-.7.767c1.074.8,1.7,1.963,1.338,2.593a3.893,3.893,0,0,0-.19-.785,4.935,4.935,0,0,0-.513-.69c-.993,1.1-2.345.941-3.617,1.077v.892a2.777,2.777,0,0,1,.753.018c.149.045.238.256.354.392a3.5,3.5,0,0,1-.406.21c-.314.114-.635.21-.966.318.051.6.013,1.131.691,1.5a1.6,1.6,0,0,1,.557,1.271c-.065,1.446-.266,2.885-.418,4.337L14,24.223c.229-.49.482-1.04.786-1.691-.676-.049-1-.718-1.846-.386a10.531,10.531,0,0,1-2.647.416c-.71-.685-1.164-1.179-1.678-1.6a3.77,3.77,0,0,1-.905-.722c-.265-.369-.892-.51-1.348-.743-.015-.007-.046.022-.068.021-.9-.061-1.749-.63-2.724-.18-.218.1-.661-.32-1.015-.464-.257-.106-.554-.114-.805-.229C1.232,18.393.722,18.111,0,17.74Z" transform="translate(0 0)"/>
                      </g>
                    </g>
                </svg>
                <span class="text-gray-700">{{ __('Nodes') }}</span>
            </a>
            @endcan
            @can('index_legal_information')
            <a href="{{ route('legal-informations.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="mr-1/12 ml-1 text-black" style="width: 18px;" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="text-gray-700">{{ __('Legal informations') }}</span>
            </a>
            @endcan
            @can('index_knowledge_area')
            <a href="{{ route('knowledge-areas.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 26.465 19.941">
                    <g transform="translate(0 -44.37)">
                      <path d="M26.086,63.615H21.713l1.548-.445a.983.983,0,0,0,.592-.454.853.853,0,0,0,.069-.706L18.152,45.02a.994.994,0,0,0-.959-.65,1.084,1.084,0,0,0-.3.042l-3.547,1.02c-.034.01-.067.021-.1.034v-.134a.968.968,0,0,0-1-.925H8.5a1.054,1.054,0,0,0-.627.2,1.057,1.057,0,0,0-.628-.2H3.5a.969.969,0,0,0-1.006.925V63.615H.378a.349.349,0,1,0,0,.7H26.086a.349.349,0,1,0,0-.7Zm-2.9-1.222a.244.244,0,0,1-.147.113l-3.547,1.02a.266.266,0,0,1-.074.01.251.251,0,0,1-.239-.162L14.923,50.848l4.023-1.156L23.2,62.218A.211.211,0,0,1,23.183,62.393ZM18.721,49.028,14.7,50.184l-.46-1.355,4.023-1.156ZM13.571,46.1l3.548-1.02a.268.268,0,0,1,.074-.011.246.246,0,0,1,.237.161l.605,1.782-4.023,1.156-.6-1.781A.228.228,0,0,1,13.571,46.1Zm4.9,17.519H13.247V48.244ZM8.254,52.482H12.49v.969H8.254Zm4.237-.7H8.254v-3.4h4.237ZM7.5,49.305H3.253v-.924H7.5ZM3.253,50H7.5v.924H3.253Zm5,4.145H12.49v9.469H8.254ZM8.5,45.1h3.74a.24.24,0,0,1,.249.229v2.354H8.254V45.332A.24.24,0,0,1,8.5,45.1Zm-5,0H7.247a.241.241,0,0,1,.251.229v2.354H3.253V45.332A.241.241,0,0,1,3.5,45.1Zm-.25,6.519H7.5V63.615H3.253Z"/>
                    </g>
                </svg>
                <span class="text-gray-700">{{ __('Knowledge areas') }}</span>
            </a>
            @endcan
            @can('index_knowledge_subarea')
            <a href="{{ route('knowledge-subareas.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 26.465 19.941">
                    <g transform="translate(0 -44.37)">
                      <path d="M26.086,63.615H21.713l1.548-.445a.983.983,0,0,0,.592-.454.853.853,0,0,0,.069-.706L18.152,45.02a.994.994,0,0,0-.959-.65,1.084,1.084,0,0,0-.3.042l-3.547,1.02c-.034.01-.067.021-.1.034v-.134a.968.968,0,0,0-1-.925H8.5a1.054,1.054,0,0,0-.627.2,1.057,1.057,0,0,0-.628-.2H3.5a.969.969,0,0,0-1.006.925V63.615H.378a.349.349,0,1,0,0,.7H26.086a.349.349,0,1,0,0-.7Zm-2.9-1.222a.244.244,0,0,1-.147.113l-3.547,1.02a.266.266,0,0,1-.074.01.251.251,0,0,1-.239-.162L14.923,50.848l4.023-1.156L23.2,62.218A.211.211,0,0,1,23.183,62.393ZM18.721,49.028,14.7,50.184l-.46-1.355,4.023-1.156ZM13.571,46.1l3.548-1.02a.268.268,0,0,1,.074-.011.246.246,0,0,1,.237.161l.605,1.782-4.023,1.156-.6-1.781A.228.228,0,0,1,13.571,46.1Zm4.9,17.519H13.247V48.244ZM8.254,52.482H12.49v.969H8.254Zm4.237-.7H8.254v-3.4h4.237ZM7.5,49.305H3.253v-.924H7.5ZM3.253,50H7.5v.924H3.253Zm5,4.145H12.49v9.469H8.254ZM8.5,45.1h3.74a.24.24,0,0,1,.249.229v2.354H8.254V45.332A.24.24,0,0,1,8.5,45.1Zm-5,0H7.247a.241.241,0,0,1,.251.229v2.354H3.253V45.332A.241.241,0,0,1,3.5,45.1Zm-.25,6.519H7.5V63.615H3.253Z"/>
                    </g>
                </svg>
                <span class="text-gray-700">{{ __('Knowledge subareas') }}</span>
            </a>
            @endcan
            @can('index_knowledge_subarea_discipline')
            <a href="{{ route('knowledge-subarea-disciplines.index') }}" class="w-full flex items-center md:mt-4 py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1/12 ml-1 text-black" style="width: 18px; flex-basis: 26px;" viewBox="0 0 26.465 19.941">
                    <g transform="translate(0 -44.37)">
                      <path d="M26.086,63.615H21.713l1.548-.445a.983.983,0,0,0,.592-.454.853.853,0,0,0,.069-.706L18.152,45.02a.994.994,0,0,0-.959-.65,1.084,1.084,0,0,0-.3.042l-3.547,1.02c-.034.01-.067.021-.1.034v-.134a.968.968,0,0,0-1-.925H8.5a1.054,1.054,0,0,0-.627.2,1.057,1.057,0,0,0-.628-.2H3.5a.969.969,0,0,0-1.006.925V63.615H.378a.349.349,0,1,0,0,.7H26.086a.349.349,0,1,0,0-.7Zm-2.9-1.222a.244.244,0,0,1-.147.113l-3.547,1.02a.266.266,0,0,1-.074.01.251.251,0,0,1-.239-.162L14.923,50.848l4.023-1.156L23.2,62.218A.211.211,0,0,1,23.183,62.393ZM18.721,49.028,14.7,50.184l-.46-1.355,4.023-1.156ZM13.571,46.1l3.548-1.02a.268.268,0,0,1,.074-.011.246.246,0,0,1,.237.161l.605,1.782-4.023,1.156-.6-1.781A.228.228,0,0,1,13.571,46.1Zm4.9,17.519H13.247V48.244ZM8.254,52.482H12.49v.969H8.254Zm4.237-.7H8.254v-3.4h4.237ZM7.5,49.305H3.253v-.924H7.5ZM3.253,50H7.5v.924H3.253Zm5,4.145H12.49v9.469H8.254ZM8.5,45.1h3.74a.24.24,0,0,1,.249.229v2.354H8.254V45.332A.24.24,0,0,1,8.5,45.1Zm-5,0H7.247a.241.241,0,0,1,.251.229v2.354H3.253V45.332A.241.241,0,0,1,3.5,45.1Zm-.25,6.519H7.5V63.615H3.253Z"/>
                    </g>
                </svg>
                <span class="text-gray-700">{{ __('Knowledge subarea disciplines') }}</span>
            </a>
            @endcan

            {{-- dropdown que  que puede visualizar el coordinador de cada nodo--}}
            @if ($node)
                @if( $authUser->hasRole(2) )
                    <div @click.away="open = false" class="static" x-data="{ open: false }">
                        <button @click="open = !open" class="flex flex-row items-center justify-between w-full py-2 mt-2 text-sm font-semibold text-left bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                            <span class="capitalize">Nodo {{ $node->state }}</span>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg z-10">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                <a href="{{ route('dashboard') }}" class="ml-2 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Dashboard') }}</span>
                                </a>

                                <a href="{{ route('nodes.events.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Node events') }}</span>
                                </a>
                                @can('index_annual_node_event')
                                <a href="{{ route('annualNodeEvent.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ __('Annual node events') }}</span>
                                </a>
                                @endcan
                                @can('index_educational_institution')
                                <a href="{{ route('nodes.educational-institutions.index', [$node]) }}" class="ml-2 mr-2 w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
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
                    {{-- <div>
                        <x-drop-down-educational-institution />
                    </div>

                    <hr class="mt-4 mb-4"> --}}

                    <a href="{{ route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution]) }}" id="faculties" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-gray-700">{{ __('Faculties') }}</span>
                    </a>

                    <a href="{{ route('notifications.indexAdminInstitution') }}" id="faculties" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-gray-700">{{ __('Solicitudes participancion proyectos') }}</span>
                    </a>




                    @if ( request()->route('faculty') )
                        <p class="bg-gray-100 mt-4 p-4 text-center"><strong>{{ $educationalInstitutionFaculty->name }}</strong></p>
                        @can('index_academic_program')
                        <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="academic_programs" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 bg-gray-100 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                            <span class="text-gray-700">{{ __('Academic programs') }}</span>
                        </a>
                        @endcan
                        @can('index_research_group')
                        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="research_groups" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 bg-gray-100 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.216" height="15.209" viewBox="0 0 17.216 15.209" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                <path id="Path_109" data-name="Path 109" d="M16.531,13.434a1.651,1.651,0,0,0-.844-.452l-1.971-.394a4.953,4.953,0,0,0-3.187.427l-.263.13a4.953,4.953,0,0,1-3.187.427l-1.594-.319A1.651,1.651,0,0,0,4,13.706M7.1,4h6.6l-.826.826V9.1a1.651,1.651,0,0,0,.484,1.167l4.128,4.128a1.651,1.651,0,0,1-1.168,2.818H4.478A1.651,1.651,0,0,1,3.311,14.39l4.128-4.128A1.651,1.651,0,0,0,7.923,9.1V4.826Z" transform="translate(-1.791 -3)" fill="#fff" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                            </svg>
                            <span class="text-gray-700">{{ __('Research groups') }}</span>
                        </a>
                        @endcan
                        @can('index_educational_environment')
                        <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="educational_environments" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 bg-gray-100 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-gray-700">{{ __('Educational environments') }}</span>
                        </a>
                        @endcan
                        @can('index_educational_institution_user')
                        <a href="{{ route('nodes.educational-institutions.faculties.users.index', [$node, $educationalInstitution, $educationalInstitutionFaculty]) }}" id="users" class="w-full flex items-center py-2  text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 bg-gray-100 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
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
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                <span>Dropdown</span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg z-10">
                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4" href="#">Link #1</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4" href="#">Link #2</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4" href="#">Link #3</a>
                </div>
                </div>
            </div> --}}
            {{-- links del sidebar que se muestran al usuario tipo empresa --}}
            @if( Auth::user()->hasRole(5) )
                <a href="#" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg"class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 32 32">
                        <g >
                          <rect width="32" height="32" fill="none"/>
                          <path d="M406-333.194h8.645V-344H406v10.806Zm0,8.645h8.645v-6.484H406v6.484Zm10.806,0h8.645v-10.806h-8.645v10.806Zm0-19.452v6.484h8.645V-344Z" transform="translate(-399.516 350.484)" fill-rule="evenodd"/>
                        </g>
                    </svg>
                    <span class="text-gray-700">{{ __('Observatorio') }}</span>
                </a>
                <a href="#" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-gray-700">{{ __('Ideas empresariales') }}</span>
                </a>
                <a href="#" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="mr-1/12 ml-1 text-black" style="width: 18px;" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="text-gray-700">{{ __('Blog de experiencias') }}</span>
                </a>
                <a href="#" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17.216" height="15.209" viewBox="0 0 17.216 15.209" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                        <path id="Path_109" data-name="Path 109" d="M16.531,13.434a1.651,1.651,0,0,0-.844-.452l-1.971-.394a4.953,4.953,0,0,0-3.187.427l-.263.13a4.953,4.953,0,0,1-3.187.427l-1.594-.319A1.651,1.651,0,0,0,4,13.706M7.1,4h6.6l-.826.826V9.1a1.651,1.651,0,0,0,.484,1.167l4.128,4.128a1.651,1.651,0,0,1-1.168,2.818H4.478A1.651,1.651,0,0,1,3.311,14.39l4.128-4.128A1.651,1.651,0,0,0,7.923,9.1V4.826Z" transform="translate(-1.791 -3)" fill="#fff" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                    <span class="text-gray-700">{{ __('Proveedores') }}</span>
                </a>
                <a href="#" class="mt-4 mb-4 mr-2 w-full flex items-center py-2 text-sm text-blue-900 hover:bg-gray-200 px-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mr-1/12 ml-1 text-black" style="width: 18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="text-gray-700">{{ __('Perfil') }}</span>
                </a>
            @endif
        </nav>
    </div>
</div>
