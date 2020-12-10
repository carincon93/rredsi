<x-guest-layout>
    
    <x-guest-header :node="$node" />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4" style="background: url(/storage/images/net.png)">
                <div class="mt-8 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-4 h-64" style="background: url(/storage/images/cowork.jpg); background: url(/storage/images/cowork.jpg);background-size: cover;background-repeat: no-repeat;">
                    <div class="p-6">
                        <div class="flex items-center mt-4">
                            <div>
                                <h1 class="text-5xl text-center leading-none text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-12 w-12 inline mb-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Encuentre proyectos de su interés y trabaje de forma colaborativa con otros semilleros de investigación
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 mt-4">
                <h1 class="mb-10 text-gray-400">{{ count($projects) }} resultado(s) para: {{ $search }}</h1>
                @forelse ($projects->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $project)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                        </div>
                                        <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="ml-2 inline-flex items-center space-x-1 text-xs px-2 bg-gray-200 text-gray-800 rounded-full mb-4">
                                            <div style="width: 0.4rem; height: 0.4rem" class="bg-gray-50 rounded-full"></div>
                                            <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $project->projectType->type]) }}" class="text-gray-400 uppercase ml-2"><small>{{ $project->projectType->type }}</small></a>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        <a href="{{ route('nodes.explorer.searchProjects.showProject', [$node, $project]) }}" class="text-center">
                                            <h2 class=" text-xl title-font font-medium mb-3">{{ $project->title }}</h2>
                                            
                                            <p class="leading-relaxed text-sm text-justify">
                                                <small>{{ substr($project->abstract, 0, 250) }}...</small>
                                            </p>
                                            <div class="mt-4 m-auto block">
                                                <x-jet-button>
                                                    {{ __('Show more') }}

                                                    <div class="ml-1 text-white">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </div>
                                                </x-jet-button>
                                            </div>
                                        </a>
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
            </div>
        </div>
    </div>
    <div class="py-2 border-t">
        <div class="p-6 mt-4">
            @foreach ($allKeywords->chunk(5) as $chunk)
                <div class="flex justify-around mt-4 sm:items-center sm:justify-around text-center text-sm text-gray-500 sm:text-left">
                    @foreach ($chunk as $keyword)
                        <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $keyword]) }}" class="ml-1 underline">{{ $keyword }}</a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>