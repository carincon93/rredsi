<x-guest-layout>

    <x-guest-header :node="$node" :image="$project->main_image">
        <x-slot name="title">
            <h1 class="text-3xl sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline"> 
                    {{ $project->title }}
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            {{ substr($project->abstract, 0 ,310) }}@if(count_chars($project->abstract) > 310)...@endif
        </x-slot>
        <x-slot name="actionButton">
            @if ($project->roles_requirements)
                <div class="flex items-center mb-2 ml-2 mt-2">
                    <div class="inline-flex flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" x-description="Heroicon name: exclamation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <p class="inline-flex ml-2 mr-2 text-gray-500">Este proyecto requiere de participantes</p>
                </div>
                <a href="#role-requirements" class="w-full flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 md:text-lg md:px-10">
                    {{ __('Show more') }}
                </a>
            @endif
        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="p-8 mt-4">
                <h1 class="text-2xl mt-12 ml-16">{{ __('Authors') }}</h1>
                @forelse ($project->authors->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $author)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        @if ($author->profile_photo_url)
                                            <img class="h-10 w-10 rounded-full" src="{{ $author->profile_photo_url }}" alt="{{ $author->name }}" />
                                        @else
                                            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow ">
                                        
                                        <h2 class=" text-xl title-font font-medium mb-3">
                                            <a href="{{ route('nodes.explorer.searchRoles.showUser', [$node, $author]) }}" target="_blank">{{ $author->name }}</a>
                                        </h2>
                                        <p class="leading-relaxed text-sm text-justify">
                                            <small></small>
                                        </p>
                                        
                                        @php
                                            $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();
                                        @endphp
                                    </div>
                                </div>
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ optional($researchTeam->researchGroup)->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                    <p class="text-gray-400"><small>Grupo de investigación: {{ optional($researchTeam->researchGroup)->educationalInstitutionFaculty->name }}</small></p>
                                    <p class="text-gray-400"><small>Semillero de investigación: {{ $researchTeam->name }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Abstract') }}</h1>
                <p class="mt-4 whitespace-pre-line">{{ $project->abstract }}</p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Keywords') }}</h1>
                <p class="mt-4 text-gray-400">
                    @foreach (explode(',', implode(json_decode($project->keywords))) as $keyword)
                        <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $keyword]) }}" class="ml-1 underline">{{ $keyword }}</a>
                    @endforeach
                </p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Overall objective') }}</h1>
                <p class="mt-4 whitespace-pre-line">{{ $project->overall_objective }}</p>
                <x-jet-section-border />

                @if (Storage::disk('public')->exists($project->file))
                    <h1 class="text-2xl">{{ __('File') }}</h1>
                    <a href="{{ url("storage/$project->file") }}" class="mt-4 underline" target="_blank" download>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Descargar archivo
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="relative bg-cool-gray-200 overflow-hidden" id="role-requirements">
        <div class="mx-auto">
            <div class="relative pl-4 z-10 lg:max-w-2xl flex items-center h-64 lg:w-full">
                <div class="inline-flex flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" x-description="Heroicon name: exclamation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="inline-flex ml-4 text-4xl tracking-tight font-extrabold leading-none">
                        <span class="block xl:inline">Este proyecto está buscando jóvenes investigadores</span>
                    </h1>
                    <p class="mt-4 ml-4">A continuación se explican los requerimientos del proyecto</p>
                </div>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ url("storage/images/AdobeStock_Hiring.jpeg") }}">
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="p-8 mt-4">

                <h1 class="text-2xl text-center mb-12 mt-12">{{ __('Roles requirements description') }}</h1>

                <p class="mt-4 text-center whitespace-pre-line">{{ $project->roles_requirements_description }}</p>

                <div>
                    <h1 class="text-2xl text-center mb-12 mt-12">{{ __('Roles requirements') }}</h1>
                    <ul class="pl-1/3" style="list-style: circle;">
                        @foreach (explode(',', implode(json_decode($project->roles_requirements))) as $roles_requirement)
                            <li>{{ $roles_requirement }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-10 flex items-center">
                    <x-jet-button class="m-auto inline-flex">
                        {{ __('I want to participate') }}

                        <div class="ml-1 text-white">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                    </x-jet-button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>