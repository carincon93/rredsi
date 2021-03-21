<x-guest-layout>

    <x-guest-header :node="$node" image="images/AdobeStock_SchoolSpeaker.jpeg">
        <x-slot name="title">
            <h1 class="text-5xl sm:text-4xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="h-7 inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg>
                    #EventosRREDSI{{ $node->state }}{{ date('Y') }}
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            Consulte los eventos {{ date('Y') }} de las diferentes instituciones educativas y participe inscribiendo sus proyectos
        </x-slot>
        <x-slot name="actionButton">
            <a href="#results" class="w-full flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 md:text-lg md:px-10">
                {{ __('Get started') }}
            </a>
        </x-slot>
    </x-guest-header>

    <div class="py-12" id="results">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 mt-4">

                @if ($search)
                    <h1 class="mb-10 text-gray-400">{{ count($node->events) }} resultado(s) para: {{ $search }}</h1>
                @endif

                @forelse ($node->events as $event)

                    <x-jet-section-border />

                    <div>
                        <div class="p-4">
                            <p class="pre-line-initial text-2xl mb-8">{{ $event->name }}</p>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="pre-line-initial mb-2 inline-flex">
                                {{ __('Description') }}:
                            </p>
                            <p class="pre-line-initial text-justify text-gray-400 mb-4 ml-8">
                                <small>
                                    {{ $event->description }}
                                </small>
                            </p>

                            <div class="grid grid-cols-4">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="pre-line-initial mb-2 inline-flex">{{ __('Dates') }}</p>
                                    <p class="pre-line-initial text-gray-400 ml-8">
                                        <small>{{ $event->datesForHumans }}</small>
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                    </svg>
                                    <p class="pre-line-initial mt-2 inline-flex">{{ __('Host') }}</p>
                                    <p class="pre-line-initial text-gray-400 ml-8">
                                        <small>{{ optional($event->nodeEvent)->node->state ?? optional($event->educationalInstitutionEvent)->educationalInstitution->name }}</small>
                                    </p>
                                </div>

                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="pre-line-initial mt-2 inline-flex">{{ __('Location') }}</p>
                                    <p class="pre-line-initial text-gray-400 ml-8">
                                        <small>{{ $event->location }}</small>
                                    </p>
                                </div>
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 mt-2 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                    <p class="pre-line-initial mt-2 inline-flex">{{ __('Info link') }}</p>
                                    <p class="pre-line-initial text-gray-400 ml-8">
                                        <a href="{{ $event->info_link }}" target="_blank" class="underline"><small>{{ $event->info_link }}</small></a>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-8">
                                <p class="pre-line-initial mt-2 inline-flex">{{ __('Knowledge subarea disciplines') }}</p>
                                <p class="pre-line-initial text-gray-400 mt-2">
                                    @forelse ($event->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                                        @if ($knowledgeSubareaDiscipline !== $event->knowledgeSubareaDisciplines->last())
                                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }},</small></a>
                                        @else
                                            <a class="underline" href="{{ route('nodes.explorer.events', [$node, 'search' => $knowledgeSubareaDiscipline->name]) }}"><small>{{ $knowledgeSubareaDiscipline->name }}</small></a>
                                        @endif
                                    @empty
                                        <p class="text-gray-400">{{ __('No data recorded') }}</p>
                                    @endforelse
                                </p>
                            </div>

                            <x-jet-button class="modal-open mt-4">
                                <div class="mr-1 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                {{ __('I want to participate') }}
                            </x-jet-button>
                        </div>
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-footer :legalInformations="$legalInformations" />

    @if(isset($event))
        <x-dialog-modal-form-event-project :eventId="$event->id" :projects="$projects" />
    @endif

</x-guest-layout>
