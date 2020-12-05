<x-app-layout>

    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ $educationalInstitution->name }}
            <span class="sm:block text-purple-300">

            </span>
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="container mx-auto">
            <h1 class="text-3xl mb-4">Bienvenido(a) {{ Auth::user()->name }}</h1>
            <h1 class="text-gray-400 mb-4">Administre los módulos relacionados con la institución educativa <span class="text-uppercase">{{ $educationalInstitution->name }}</span> del nodo <span clas="text-capitalize">{{ $node->state }}</span>.</h1>
            <div class="grid md:grid-cols-3 gap-4">

            <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white  hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex" >
                    <a href="{{ route('nodes.educational-institutions.academic-programs.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ count($educationalInstitution->academicPrograms) }} programa(s) de formación</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('Academic programs') }}</h1>
                    </a>
                </div>

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4">
                    <a href="{{ route('nodes.educational-institutions.research-groups.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ count($educationalInstitution->researchGroups) }} grupo(s) de investigación</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('Research groups') }}</h1>
                        <p class="text-center text-gray-500">Administre grupos de investigación, semilleros de investigación, líneas de investigación y proyectos de semilleros de investigación.</p>
                    </a>
                </div>

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.educational-environments.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ count($educationalInstitution->educationalEnvironments) }} ambiente(s) de formación</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('Educational environments') }}</h1>
                        <p class="text-center text-gray-500">Administre ambientes, herramientas y equipos.</p>
                    </a>
                </div>
            </div>

            <x-jet-section-border />

            <div class="grid md:grid-cols-3 gap-4">

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.events.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ $educationalInstitution->educationalInstitutionEvent()->where('educational_institution_id', $educationalInstitution->id)->count() }} evento(s)</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('Events') }}</h1>
                    </a>
                </div>

                <div class="transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.users.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ $educationalInstitution->educationalInstitutionEvent()->where('educational_institution_id', $educationalInstitution->id)->count() }} evento(s)</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('Users') }}</h1>
                    </a>
                </div>

                <div class=" transition duration-500 ease-in-out transform hover:-translate-y-1 h-64 bg-white hover:bg-gray-200 overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.dashboard.bi', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{-- <h1 class="text-gray-400">{{ $educationalInstitution->educationalInstitutionEvent()->where('educational_institution_id', $educationalInstitution->id)->count() }} evento(s)</h1> --}}
                        <h1 class="text-2xl text-gray-400">{{ __('BI') }}</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
