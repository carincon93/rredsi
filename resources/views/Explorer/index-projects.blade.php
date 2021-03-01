<x-guest-layout>
    
    <x-guest-header :node="$node" image="">
        <x-slot name="title">
            <h1 class="text-3xl text-center sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg> 
                    Explorer: Trabaje de forma colaborativa en proyectos de <br>investigación de semilleros de la red
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
                {{ count($projects) }} resultado(s) para: {{ $search }}
        </x-slot>
        <x-slot name="actionButton">
            
        </x-slot>
    </x-guest-header>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 mt-4">
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
                                            <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $project->projectType->type]) }}" class="text-gray-400 uppercase ml-2"><small>{{ optional($project->projectType)->type }}</small></a>
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
                                    <p class="text-gray-400"><small>Institución educativa: {{ optional($researchTeam->researchGroup)->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                    <p class="text-gray-400"><small>Grupo de investigación: {{ optional($researchTeam->researchGroup)->name }}</small></p>
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