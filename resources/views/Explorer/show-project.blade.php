<x-guest-layout>

    <x-guest-header :node="$node" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4" style="background: url(/storage/images/net.png)">
                <div class="mt-8 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-4 h-64 bg-white">
                    <div class="p-6">
                        <div class="flex items-center mt-4">
                            <div class="w-full">
                                <h1 class="text-5xl text-center leading-none text-gray-900">
                                    {{ $project->title }}
                                </h1>
                                <p class="mt-10 text-gray-400">
                                    {{ __('Authors')}}:
                                    @foreach ($project->authors as $author)
                                        @if ($author !== $project->authors->last())
                                            {{ $author->name }},
                                        @else
                                            {{ $author->name }}
                                        @endif
                                    @endforeach
                                </p>
                                <p class="mt-2 text-gray-400">
                                    Fecha de ejecución: {{ $project->datesForHumans }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-8 mt-4">
                <h1 class="text-2xl">{{ __('Abstract') }}</h1>
                <p class="mt-4">{{ $project->abstract }}</p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Keywords') }}</h1>
                <p class="mt-4 text-gray-400">
                    @foreach (explode(',', implode(json_decode($project->keywords))) as $keyword)
                        <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $keyword]) }}" class="ml-1 underline">{{ $keyword }}</a>
                    @endforeach
                </p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Overall objective') }}</h1>
                <p class="mt-4">{{ $project->overall_objective }}</p>
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

                <x-jet-section-border />

                <h1 class="text-2xl mt-12">{{ __('Authors') }}</h1>
                @forelse ($project->authors->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $author)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        
                                        <h2 class=" text-xl title-font font-medium mb-3">{{ $author->name }}</h2>
                                        
                                        <p class="leading-relaxed text-sm text-justify">
                                            <small></small>
                                        </p>
                                        
                                        @php
                                            $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();
                                        @endphp
                                    </div>
                                </div>
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ $researchTeam->researchGroup->educationalInstitution->name }}</small></p>
                                    <p class="text-gray-400"><small>Grupo de investigación: {{ $researchTeam->researchGroup->name }}</small></p>
                                    <p class="text-gray-400"><small>Semillero de investigación: {{ $researchTeam->name }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse

                <x-jet-section-border />

                <h1 class="text-2xl mt-12">{{ __('Roles requirements') }}</h1>
                <ul>
                    @foreach (json_decode($project->roles_requirements) as $roles_requirement)
                        <li>{{ substr($roles_requirement, 0, -1) }}</li>
                    @endforeach
                </ul>

                <h1 class="text-2xl mt-12">{{ __('Roles requirements description') }}</h1>

                <p class="mt-4">{{ $project->roles_requirements_description }}</p>
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

    <x-footer />

</x-guest-layout>