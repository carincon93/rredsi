<div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-gray-100 border-r z-30" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">
    <div class="animate-pulse h-16 border-b px-4 items-center mb-8 flex">
        <a class="pl-16" href="{{ route('nodes.dashboard', [request()->route('node') ? request()->route('node') : 1]) }}"><!-- Quemado -->
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>
    </div>
    
    <div class="mb-4 px-4">
        @if (request()->route('node'))
            @php
                $node = request()->route('node');
            @endphp
        @endif
        <div class="mb-4">
            <p class="capitalize text-center">Nodo <span class="capitalize">{{ $node->state }}</span></p>
        </div>
        <p class="pl-4 text-sm font-semibold mb-1">{{ __('Manage node') }}</p>
        <a href="{{ route('nodes.dashboard', [$node]) }}" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
            <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
            </svg>
            <span class="text-gray-700">{{ __('Dashboard') }}</span>
        </a>
        <a href="{{ route('nodes.events.index', [$node]) }}" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
            <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
            </svg>
            <span class="text-gray-700">{{ __('Node events') }}</span>
        </a>
        <a href="{{ route('nodes.educational-institutions.index', [$node]) }}" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
            <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
            </svg>
            <span class="text-gray-700">{{ __('Educational institutions') }}</span>
        </a>
    </div>
    
    <div class="mb-4 px-4">
        <div class="mb-8 mt-4">
            <x-drop-down-educational-institution-faculties />
        </div>
        @if (request()->route('educational_institution'))
            @php
                $educationalInstitution = request()->route('educational_institution');
            @endphp
            <p class="pl-4 text-sm font-semibold mb-1">{{ __('Manage educational institution faculties') }}</p>
            <a href="{{ route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution]) }}" d="academic_programs" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                </svg>
                <span class="text-gray-700">{{ __('Faculties') }}</span>
            </a>
        @endif
        @if (request()->route('faculty'))
            @php
                $faculty = request()->route('faculty');
            @endphp
            
            <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty]) }}" id="academic_programs" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                </svg>
                <span class="text-gray-700">{{ __('Academic programs') }}</span>
            </a>
            
            <a href="{{ route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty]) }}" id="research_groups" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                </svg>
                <span class="text-gray-700">{{ __('Research groups') }}</span>
            </a>
            
            <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $faculty]) }}" id="educational_environments" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                </svg>
                <span class="text-gray-700">{{ __('Educational environments') }}</span>
            </a>
            
            <a href="{{ route('nodes.educational-institutions.faculties.users.index', [$node, $educationalInstitution, $faculty]) }}" id="users" class="w-full flex items-center text-sm text-blue-900 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                    <path d="M15.396,2.292H4.604c-0.212,0-0.385,0.174-0.385,0.386v14.646c0,0.212,0.173,0.385,0.385,0.385h10.792c0.211,0,0.385-0.173,0.385-0.385V2.677C15.781,2.465,15.607,2.292,15.396,2.292 M15.01,16.938H4.99v-2.698h1.609c0.156,0.449,0.586,0.771,1.089,0.771c0.638,0,1.156-0.519,1.156-1.156s-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.321-1.089,0.771H4.99v-3.083h1.609c0.156,0.449,0.586,0.771,1.089,0.771c0.638,0,1.156-0.518,1.156-1.156c0-0.638-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.322-1.089,0.771H4.99V6.531h1.609C6.755,6.98,7.185,7.302,7.688,7.302c0.638,0,1.156-0.519,1.156-1.156c0-0.638-0.519-1.156-1.156-1.156c-0.503,0-0.933,0.322-1.089,0.771H4.99V3.062h10.02V16.938z M7.302,13.854c0-0.212,0.173-0.386,0.385-0.386s0.385,0.174,0.385,0.386s-0.173,0.385-0.385,0.385S7.302,14.066,7.302,13.854 M7.302,10c0-0.212,0.173-0.385,0.385-0.385S8.073,9.788,8.073,10s-0.173,0.385-0.385,0.385S7.302,10.212,7.302,10 M7.302,6.146c0-0.212,0.173-0.386,0.385-0.386s0.385,0.174,0.385,0.386S7.899,6.531,7.688,6.531S7.302,6.358,7.302,6.146"></path>
                </svg>
                <span class="text-gray-700">{{ __('Users') }}</span>
            </a>
        @endif
    </div>
</div>
