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
                                    {{ __('Authors')}}
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
                <p class="mt-10 text-gray-400">
                    {{ __('Keywords') }}:
                    @foreach (explode(',', implode(json_decode($project->keywords))) as $keyword)
                        <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $keyword]) }}" class="ml-1 underline">{{ $keyword }}</a>
                    @endforeach
                </p>
            </div>
            <div class="p-8 mt-4">
                <h1 class="text-2xl">{{ __('Overall objective') }}</h1>
                <p class="mt-4">{{ $project->overall_objective }}</p>
            </div>

            <div class="mt-10 flex items-center">
                <x-jet-button class="m-auto inline-flex">
                    {{ __('Contact') }}

                    <div class="ml-1 text-white">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </div>
                </x-jet-button>
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>