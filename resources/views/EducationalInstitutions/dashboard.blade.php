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
            <div class="grid md:grid-cols-3 gap-4">
                {{-- <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4">
                    <a href="#" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h1 class="text-2xl capitalize text-gray-400">{{ __('users') }}</h1>
                    </a>
                </div> --}}
                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.academic-programs.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-2xl text-gray-400">{{ __('Academic programs') }}</h1>
                    </a>
                </div>
                {{-- <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="#" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-2xl capitalize text-gray-400">{{ __('projects') }}</h1>
                    </a>
                </div> --}}
            </div>
            <div class="grid md:grid-cols-3 gap-4 mt-4">
                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4">
                    <a href="{{ route('nodes.educational-institutions.research-groups.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h1 class="text-2xl text-gray-400">{{ __('Research groups') }}</h1>
                    </a>
                </div>
                {{-- <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.research-teams.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-2xl text-gray-400">{{ __('Research teams') }}</h1>
                    </a>
                </div> --}}
                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <a href="{{ route('nodes.educational-institutions.educational-environments.index', [$node, $educationalInstitution]) }}" class="flex flex-col h-56 items-center justify-around w-96">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-14 h-14 text-gray-400">
                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                        <h1 class="text-2xl text-gray-400">{{ __('Educational environments') }}</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>