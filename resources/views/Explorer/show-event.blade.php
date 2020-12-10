<x-guest-layout>

    <x-guest-header :node="$node" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4" style="background: url(/storage/images/net.png)">
                <div class="mt-8 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-4 h-64 bg-white" style="background: url(/storage/images/school-speaker.jpg); background-repeat: no-repeat; background-size: cover;">
                    <div class="p-6">
                        <div class="flex items-center mt-4">
                            <div class="w-full">
                                <h1 class="text-5xl text-center leading-none text-white">
                                    Evento: {{ $event->name }}
                                </h1>
                                <p class="text-2xl text-center text-white mt-8">#EventosRREDSI<strong>Caldas2020</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-8 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                <p class="mb-2 inline-flex">{{ __('Dates') }}</p>
                <p class="text-gray-400 ml-8">
                    <small>{{ $event->datesForHumans }}</small>
                </p>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                  </svg>
                <p class="mt-2 inline-flex">{{ __('Host') }}</p>
                <p class="text-gray-400 ml-8">
                    <small>{{ $event->nodeEvent->node->state ?? $event->educationalInstitutionEvent->educationalInstitution->name }}</small>
                </p>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="mt-2 inline-flex">{{ __('Location') }}</p>
                <p class="text-gray-400 ml-8">
                    <small>{{ $event->location }}</small>
                </p>

                <x-jet-section-border />

                <h1 class="text-2xl inline-flex">{{ __('Description') }}</h1>
                <p class="mt-4">{{ $event->description }}</p>

                <x-jet-section-border />

                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 596 532" class="h-7 mb-4 mt-2 inline-flex">
                    <path id="brain-solid" d="M208,0a63.811,63.811,0,0,0-61.8,48.2c-.8,0-1.4-.2-2.2-.2a64.059,64.059,0,0,0-64,64,58.973,58.973,0,0,0,1.7,14A79.31,79.31,0,0,0,40.3,234.9a79.7,79.7,0,0,0,9.1,143A73.281,73.281,0,0,0,48,392a71.955,71.955,0,0,0,72,72,67.8,67.8,0,0,0,12-1.2A71.829,71.829,0,0,0,272,440V64A64.059,64.059,0,0,0,208,0ZM576,304a79.584,79.584,0,0,0-40.3-69.1A78.705,78.705,0,0,0,544,200a80,80,0,0,0-49.7-74A63.407,63.407,0,0,0,432,48c-.8,0-1.5.2-2.2.2A63.877,63.877,0,0,0,304,64V440a71.829,71.829,0,0,0,140,22.8,67.8,67.8,0,0,0,12,1.2,71.955,71.955,0,0,0,72-72,73.279,73.279,0,0,0-1.4-14.1A80,80,0,0,0,576,304Z" transform="translate(10 10)" fill="none" stroke="#000" stroke-width="20"/>
                </svg>
                <h1 class="text-2xl inline-flex">{{ __('Knowledge subarea disciplines') }}</h1>
                <p class="text-gray-400 ml-8">
                    @forelse ($event->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                        @if ($knowledgeSubareaDiscipline !== $event->knowledgeSubareaDisciplines->last())
                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }},</small></a>
                        @else
                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }}</small></a>
                        @endif
                    @empty
                        <p class="ml-8">{{ __('No data recorded') }}</p>
                    @endforelse
                </p>

                <x-jet-section-border />

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                <h1 class="text-2xl inline-flex">{{ __('Info link') }}</h1>
                <p class="text-gray-400 ml-8">
                    <a href="{{ $event->info_link }}" target="_blank" class="underline"><small>{{ $event->info_link }}</small></a>
                </p>

                <x-jet-section-border />

                <form method="POST" action="{{ route('nodes.explorer.sendProjectToEvent', [$node, $event]) }}">
                    @csrf

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-7 mb-4 mt-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <x-jet-label for="project_id" value="Si tiene un proyecto que aplica al área de conocimiento del evento y quiere participar, por favor seleccionelo y luego de clic en '{{ __('I want to participate') }}'" class="mb-4 inline-flex" />

                    <div class="flex items-center justify-center mt-4">
                        
                        <select id="project_id" name="project_id" class="form-select w-full" required >
                            <option value="">Seleccione un proyecto</option>
                            @forelse ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->title }}</option>
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_id" class="mt-2" />

                        <x-jet-button class="ml-4">
                            {{ __('I want to participate') }}

                            <div class="ml-1 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>