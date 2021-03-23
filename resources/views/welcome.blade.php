<title>{{ "Explorer - ".config('app.name') }}</title>

<x-guest-layout>
    <x-guest-header :node="$node" image="images/AdobeStock_hero.jpeg">
        <x-slot name="title">
            <h1 class="mt-48 text-3xl text-left md:text-left md:mt-0 md:text-4xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    RREDSI-Ibis: La plataforma para el fortalecimiento de la investigación académica de {{ $node->state }}
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            Con la nueva plataforma RREDSI-Ibis ahora puede buscar proyectos de su interés que se esten trabajando en los semilleros de investigación de las {{ count($node->educationalInstitutions) }} instituciones educativas de RREDSI {{ $node->state }} y colaborar en su desarrollo o
            registre su proyecto y conecte con jóvenes investigadores de otras instituciones.
        </x-slot>
        <x-slot name="actionButton">
            <a href="#" class="w-full flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 md:text-lg md:px-10">
                {{ __('Get started') }}
            </a>
        </x-slot>
    </x-guest-header>

    <div class="mt-2/12 overflow-hidden relative" style="background: url(/storage/images/net.png)">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4">
            <div class="mt-4 md:mt-8 dark:bg-gray-800 overflow-hidden sm:rounded-lg h-64"  style="background: url(/storage/images/dots.png); background-size: cover; background-position: right; background-repeat: no-repeat;">
                <div class="p-1 md:p-6">
                    <div class="flex items-center mt-0 md:mt-4">
                        <div>
                            <h1 class="text-3xl md:text-5xl ml-1/6 leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                                    <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#000" />
                                </svg>
                                Connect: ¿Necesita apoyo para el desarrollo de su proyecto?
                            </h1>
                            <p class="ml-1/6 mt-1 md:mt-4">Fortalezca los resultados de su proyecto conectando con jóvenes investigadores de otras áreas de conocimiento y de diferentes instituciones educativas.</p>
                            <a href="{{ route('nodes.explorer.roles', $node) }}" class="ml-1/6 mt-4 active:bg-blue-900 bg-blue-900 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Más información
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-cool-gray-100">
        <p class="text-center mb-8">Realice una búsqueda de proyectos de su interés y trabaje de forma colaborativa con otros semilleros de investigación</p>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-1/12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-4">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <form class="flex-1 ml-1/12 mt-2 shadow" method="GET" action="{{ route('nodes.explorer.searchProjects', [$node]) }}">
                        <div>
                            <x-jet-input id="search" class="block w-full" type="search" name="search" value="{{ old('search') }}" placeholder="Busque proyectos por: título, palabras clave" required />
                        </div>
                    </form>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="{{ isset($node->shuffleProjects[0]) ? 'project-image' : '' }} p-6 text-white"  style="position: relative;background: url(/storage/{{ isset($node->shuffleProjects[0]) ? $node->shuffleProjects[0]->main_image : '' }}) center center;">
                            <div class="flex items-center relative z-10">
                                <div class="text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[0]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[0]->id ]) : '#' }}" class="underline text-white block" style="max-width: 340px;">{{ isset($node->shuffleProjects[0]) ? $node->shuffleProjects[0]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="relative z-10 text-white">
                                <div class="mt-2 text-white text-sm" style="max-width: 340px;">
                                    {{ isset($node->shuffleProjects[0]) ? substr($node->shuffleProjects[0]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="{{ isset($node->shuffleProjects[1]) ? 'project-image' : '' }} p-6 text-white border-t border-gray-200 md:border-t-0 md:border-l" style="position: relative;background: url(/storage/{{ isset($node->shuffleProjects[1]) ? $node->shuffleProjects[1]->main_image : '' }}) center center;">
                            <div class="flex items-center relative z-10">
                                <div class="text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[1]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[1]->id])  : '#'}}" class="underline text-white block" style="max-width: 340px;">{{ isset($node->shuffleProjects[1]) ? $node->shuffleProjects[1]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="relative z-10">
                                <div class="mt-2 text-white text-sm" style="max-width: 340px;">
                                    {{ isset($node->shuffleProjects[1]) ? substr($node->shuffleProjects[1]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="{{ isset($node->shuffleProjects[2]) ? 'project-image' : '' }} p-6 text-white border-t border-gray-200" style="position: relative;background: url(/storage/{{ isset($node->shuffleProjects[2]) ? $node->shuffleProjects[2]->main_image : '' }}) center center;">
                            <div class="flex items-center relative z-10">
                                <div class="text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[2]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[2]->id])  : '#'}}" class="underline text-white block" style="max-width: 340px;">{{ isset($node->shuffleProjects[2]) ? $node->shuffleProjects[2]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="relative z-10">
                                <div class="mt-2 text-white text-sm" style="max-width: 340px;">
                                    {{ isset($node->shuffleProjects[2]) ? substr($node->shuffleProjects[2]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="{{ isset($node->shuffleProjects[3]) ? 'project-image' : '' }} p-6 text-white border-t border-gray-200 md:border-l" style="position: relative;background: url(/storage/{{ isset($node->shuffleProjects[3]) ? $node->shuffleProjects[3]->main_image : '' }}) center center;">
                            <div class="flex items-center relative z-10">
                                <div class="text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[3]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[3]->id])  : '#'}}" class="underline text-white block" style="max-width: 340px;">{{ isset($node->shuffleProjects[3]) ? $node->shuffleProjects[3]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="relative z-10">
                                <div class="mt-2 text-white text-sm" style="max-width: 340px;">
                                    {{ isset($node->shuffleProjects[3]) ? substr($node->shuffleProjects[3]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($knowledgeAreas->chunk(5) as $chunk)
                    <div class="flex justify-around mt-4 sm:items-center sm:justify-around text-center text-sm text-gray-500 sm:text-left">
                        @foreach ($chunk as $knowledgeArea)
                            <a href="{{ route('nodes.explorer.searchProjects', [$node, 'search' => $knowledgeArea->name]) }}" class="ml-1 underline">
                                {{ $knowledgeArea->name }}
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <x-jet-section-border />

        <h1 class="text-xl md:text-4xl text-gray-400 leading-10 text-center mb-1/12">Infraestructura / Ambientes</h1>

        <p class="text-center mb-8">Realice una consulta de la infraestructura o ambientes que se disponen en las instituciones educativas de la red.</p>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-4">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <form class="flex-1 ml-1/12 mt-2 shadow" method="GET" action="{{ route('nodes.explorer.searchEducationalEnvironments', [$node]) }}">
                        <div>
                            <x-jet-input id="search-educational-environment" class="block w-full" type="search" name="search-educational-environment" value="{{ old('search-educational-environment') }}" placeholder="Busque infraestructura por: palabras clave" required />
                        </div>
                    </form>
                </div>

                @foreach ($knowledgeAreas->chunk(5) as $chunk)
                    <div class="flex justify-around mt-4 sm:items-center sm:justify-around text-center text-sm text-gray-500 sm:text-left">
                        @foreach ($chunk as $knowledgeArea)
                            <a href="{{ route('nodes.explorer.searchEducationalEnvironments', [$node, 'search-educational-environment' => $knowledgeArea->name]) }}" class="ml-1 underline">
                                {{ $knowledgeArea->name }}
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <x-jet-section-border />

        <h1 class="text-xl md:text-4xl text-gray-400 leading-10 text-center mb-1/12">Equipos especializados</h1>

        <p class="text-center mb-8">Realice una búsqueda de herramientas / equipos especializados que se disponen en las instituciones educativas de la red.</p>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-4">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <form class="flex-1 ml-1/12 mt-2 shadow" method="GET" action="{{ route('nodes.explorer.searchEducationalTools', [$node]) }}">
                        <div>
                            <x-jet-input id="search-educational-tool" class="block w-full" type="search" name="search-educational-tool" value="{{ old('search-educational-tool') }}" placeholder="Busque herramientas / equipos especializados por: palabras clave" required />
                        </div>
                    </form>
                </div>

                @foreach ($knowledgeAreas->chunk(5) as $chunk)
                    <div class="flex justify-around mt-4 sm:items-center sm:justify-around text-center text-sm text-gray-500 sm:text-left">
                        @foreach ($chunk as $knowledgeArea)
                            <a href="{{ route('nodes.explorer.searchEducationalTools', [$node, 'search-educational-tool' => $knowledgeArea->name]) }}" class="ml-1 underline">
                                {{ $knowledgeArea->name }}
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="p-6 mt-40">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden text-center mb-8">
                <h1 class="text-xl md:text-4xl text-gray-400 leading-10">#EventosRREDSI<strong>{{ $node->state.date('Y') }}</strong></h1>
                <p class="text-gray-800 leading-10">Consulte los eventos <strong>{{ date('Y') }}</strong> de las diferentes instituciones educativas, inscriba sus proyectos y divulgue los resultados.</p>
                <a href="{{ route('nodes.explorer.events', [$node]) }}" class="mt-4 active:bg-blue-900 bg-blue-900 hover:bg-blue-900 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información de próximos eventos</a>
            </div>
        </div>
    </div>
    <div class="text-left px-4 md:px-0 bg-gray-100 h-64 p-0 md:p-11 md:pl-1/6 shadow" style="background: #f7f7f7 url(/storage/images/dots.png);background-size: cover;background-position: right;background-repeat: no-repeat;">
        <h1 class="text-2xl md:text-4xl text-gray-900 leading-10">XII Encuentro departamental de semilleros de investigación <span class="capitalize">{{ $node->state }}</span></h1>
        <p class="leading-10">Del 18 al 19 de agosto de {{ date('Y') }}</p>
        <a href="{{ route('nodes.explorer.events.showRREDSIEventRegisterForm', [$node]) }}" class="mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="h-auto md:h-64 bg-cool-gray-600 p-9 md:p-11" style="background: #475569 url(/storage/images/rectangles.png); background-repeat: no-repeat; background-position: 400px; background-blend-mode: color-burn;">
            <h1 class="text-2xl md:text-4xl text-gray-300 leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[0]) ? $node->shuffleEducationalInstitutionEvents[0]->name : __('No data recorded') }}</h1>
            <p class="text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[0]) ? $node->shuffleEducationalInstitutionEvents[0]->datesForHumans : __('No data recorded') }}</p>
            @if (isset($node->shuffleEducationalInstitutionEvents[0]))
                <a href="{{ route('nodes.explorer.showEvent', [$node, $node->shuffleEducationalInstitutionEvents[0]->id]) }}" class="mt-1 md:mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-1 md:px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
            @endif
        </div>
        <div class="h-auto md:h-64 bg-cool-gray-700 p-9 md:p-11">
            <h1 class="text-2xl md:text-4xl text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[1]) ? $node->shuffleEducationalInstitutionEvents[1]->name : __('No data recorded') }}</h1>
            <p class="text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[1]) ? $node->shuffleEducationalInstitutionEvents[1]->datesForHumans : __('No data recorded') }}</p>
            @if (isset($node->shuffleEducationalInstitutionEvents[1]))
                <a href="{{ route('nodes.explorer.showEvent', [$node, $node->shuffleEducationalInstitutionEvents[1]->id]) }}" class="mt-1 md:mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-1 md:px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
            @endif
        </div>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 dark:bg-gray-800 overflow-hidden">
            <figure class="mt-24 mb-24">
                <img src="{{ url("storage/images/logos.png") }}">
            </figure>
        </div>
    </div>

    <x-footer :legalInformations="$legalInformations" />

</x-guest-layout>
