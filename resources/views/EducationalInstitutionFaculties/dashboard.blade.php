<title>{{ "Panel de control de facultad / Centro de formación - ".config('app.name') }}</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ $educationalInstitution->name }}
            <span class="sm:block text-purple-300">

            </span>
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto">
            <h1 class="m-auto text-gray-400 mb-4">Administre los módulos relacionados con la facultad de <span class="text-uppercase">{{ $faculty->name }}</span> de la institución educativa <span class="text-uppercase">{{ $educationalInstitution->name }}</span> del nodo <span clas="text-capitalize">{{ $node->state }}</span>.</h1>

            <div class="grid md:grid-cols-2 xl:grid-cols-3  gap-4">
                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white  hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex" >
                    <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-center text-2xl text-gray-400">{{ __('Academic programs') }}</h1>
                    </a>
                </div>

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4">
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty]) }}" class="flex flex-col h-56 items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h1 class="text-center text-2xl md:text-xl  xl:text-2xl text-gray-400 mx-auto">{{ __('Research groups') }}</h1>
                        <h5 class="text-center text-gray-500 mx-auto">Administre grupos de investigación, semilleros de investigación, líneas de investigación y proyectos de semilleros de investigación.</h5>
                    </a>
                </div>

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.index', [$node, $educationalInstitution, $faculty]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-center text-2xl text-gray-400">{{ __('Educational environments') }}</h1>
                        <p class="text-center text-gray-500">Administre ambientes, herramientas y equipos.</p>
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-4">

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.faculties.users.index', [$node, $educationalInstitution, $faculty]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h1 class="text-2xl text-gray-400">{{ __('Users') }}</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
