<title>{{ "Detalles del evento - ".config('app.name') }}</title>

<x-guest-layout>
    <x-guest-header :node="$node" image="images/AdobeStock_SchoolSpeaker.jpeg">
        <x-slot name="title">
            <h1 class="text-5xl sm:text-4xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="h-7 inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg>
                    #EventosRREDSICaldas2020
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            {{ $event->name }}
        </x-slot>
        <x-slot name="actionButton">
            <a href="#general-info" class="w-full flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 md:text-lg md:px-10">
                {{ __('Show more') }}
            </a>
        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 mt-4">
                <div class="grid grid-cols-4">
                    <div id="general-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mb-2 inline-flex">{{ __('Dates') }}</p>
                        <p class="pre-line-initial text-gray-400 ml-8">
                            <small>{{ $event->datesForHumans }}</small>
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                        <p class="mt-2 inline-flex">{{ __('Host') }}</p>
                        <p class="pre-line-initial text-gray-400 ml-8">
                            <small>{{ optional($event->nodeEvent)->node->state ?? optional($event->educationalInstitutionEvent)->educationalInstitution->name }}</small>
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="mt-2 inline-flex">{{ __('Location') }}</p>
                        <p class="pre-line-initial text-gray-400 ml-8">
                            <small>{{ $event->location }}</small>
                        </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <h1 class="text-2xl inline-flex">{{ __('Info link') }}</h1>
                        <p class="pre-line-initial text-gray-400 ml-8">
                            <a href="{{ $event->info_link }}" target="_blank" class="underline"><small>{{ $event->info_link }}</small></a>
                        </p>
                    </div>
                </div>

                <div class="mt-12">
                    <h1 class="text-2xl inline-flex">{{ __('Description') }}</h1>
                    <p class="mt-4 whitespace-pre-line">{{ $event->description }}</p>
                </div>

                <x-jet-section-border />

                <h1 class="text-2xl inline-flex">{{ __('Knowledge subarea disciplines') }}</h1>
                <p class="text-gray-400">
                    @forelse ($event->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                        @if ($knowledgeSubareaDiscipline !== optional($event->knowledgeSubareaDisciplines)->last())
                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }},</small></a>
                        @else
                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }}</small></a>
                        @endif
                    @empty
                        <p>{{ __('No data recorded') }}</p>
                    @endforelse
                </p>

                <x-jet-section-border />

                <form method="POST" action="{{ route('nodes.explorer.sendProjectToEvent', [$node, $event]) }}">
                    @csrf

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-7 mb-4 mt-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <x-jet-label class="mb-4" for="project_id" value="Si tiene un proyecto que aplica al área de conocimiento del evento y quiere participar, por favor seleccionelo y luego de clic en '{{ __('I want to participate') }}'" class="mb-4 inline-flex" />

                    <div class="flex items-center justify-center mt-4">

                        <select id="project_id" name="project_id" class="form-select w-full" required >
                            <option value="">Seleccione un proyecto</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->title }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="project_id" class="mt-2" />

                        <x-jet-button class="ml-4">
                            <div class="ml-1 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>

                            {{ __('I want to participate') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer :legalInformations="$legalInformations" />

</x-guest-layout>
