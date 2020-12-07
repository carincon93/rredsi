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
                <h1 class="mb-10 text-gray-400">Resultados para: {{ $search }}</h1>
                @forelse ($projects->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $project)
                            <div class="shadow p-2">
                                <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="inline-flex items-center space-x-1 text-xs px-2 bg-gray-200 text-gray-800 rounded-full mb-4">
                                    <div style="width: 0.4rem; height: 0.4rem" class="bg-gray-50 rounded-full"></div>
                                    <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $project->projectType->type]) }}" class="text-gray-400 uppercase ml-2"><small>{{ $project->projectType->type }}</small></a>
                                </div>
                                <a href="" class="text-center">
                                    <p class="mb-4">{{ $project->title }}</p>
                                    <p class="text-gray-400"><small>{{ $project->abstract }}</small></p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>