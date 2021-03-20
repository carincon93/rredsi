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
        <p class="text-center mt-8 mb-6">o</p>
        <p class="text-center mb-8">realice una búsqueda de proyectos de su interés y trabaje de forma colaborativa con otros semilleros de investigación</p>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.083" height="21" viewBox="0 0 22.083 21">
                                    <g id="project" transform="translate(13.455)">
                                        <g id="Grupo_2813" data-name="Grupo 2813" transform="translate(-13.455)">
                                        <g id="Grupo_2812" data-name="Grupo 2812" transform="translate(0)">
                                            <path id="Trazado_80" data-name="Trazado 80" d="M50.586,0H35.379a.344.344,0,0,0-.338.35V5.6h.676V.7H50.248V19.95a.34.34,0,0,1-.311.35c-.029,0-.058,0-.087,0-.06,0-.12,0-.178-.009a.037.037,0,0,1-.015,0,2.412,2.412,0,0,1-2.1-2.17.115.115,0,0,0,0-.015q-.012-.125-.012-.25v-.7a.344.344,0,0,0-.338-.35H35.717V10.5h-.676v6.3h-2.7a.344.344,0,0,0-.338.35v.7A3.1,3.1,0,0,0,35.041,21h14.9a1.026,1.026,0,0,0,.98-1.05V.35A.344.344,0,0,0,50.586,0ZM35.041,20.3a2.412,2.412,0,0,1-2.365-2.45V17.5H46.869v.35a3.347,3.347,0,0,0,.019.345c0,.03.009.06.013.09.011.085.025.169.043.252.006.029.014.058.021.087.021.084.044.167.071.249.008.023.016.047.024.07.031.087.066.172.1.255.008.017.016.035.024.051q.064.133.14.259l.02.035q.083.134.178.259l.011.015a3.192,3.192,0,0,0,.237.274A3.017,3.017,0,0,0,48,20.3Z" transform="translate(-28.841)"/>
                                            <path id="Trazado_81" data-name="Trazado 81" d="M11.55,3.5a.35.35,0,0,0,.247-.1L13.2,2a.35.35,0,0,0,0-.495L11.8.1A.35.35,0,0,0,11.55,0H1.75a1.75,1.75,0,1,0,0,3.5ZM11.46.755l1,1-1,1-.249-1ZM2.8.7h7.952l-.175.7H3.5v.7h7.077l.175.7H2.8ZM.7,1.75A1.05,1.05,0,0,1,1.75.7H2.1V2.8H1.75A1.05,1.05,0,0,1,.7,1.75Z" transform="translate(0 8.439) rotate(-20)"/>
                                            <path id="Trazado_82" data-name="Trazado 82" d="M176.352,99.2h10.5a.35.35,0,0,0,.35-.35v-10.5a.35.35,0,0,0-.6-.247L176.1,98.6a.35.35,0,0,0,.247.6ZM186.5,89.2V90.1h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7V95h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H183v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H177.2Z" transform="translate(-167.219 -84.152)"/>
                                            <path id="Trazado_83" data-name="Trazado 83" d="M292.232,207.912h3.33a.35.35,0,0,0,.35-.35v-3.33a.35.35,0,0,0-.6-.247l-3.33,3.33a.35.35,0,0,0,.247.6Zm2.98-2.835v2.135h-2.135Z" transform="translate(-278.029 -194.962)"/>
                                            <rect id="Rectángulo_542" data-name="Rectángulo 542" width="7" height="1" transform="translate(10.455 2)"/>
                                            <rect id="Rectángulo_543" data-name="Rectángulo 543" width="9" transform="translate(9.455 4)"/>
                                        </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[0]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[0]->id ]) : '#' }}" class="underline text-gray-900 dark:text-white">{{ isset($node->shuffleProjects[0]) ? $node->shuffleProjects[0]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{ isset($node->shuffleProjects[0]) ? substr($node->shuffleProjects[0]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.083" height="21" viewBox="0 0 22.083 21">
                                    <g id="project" transform="translate(13.455)">
                                        <g id="Grupo_2813" data-name="Grupo 2813" transform="translate(-13.455)">
                                        <g id="Grupo_2812" data-name="Grupo 2812" transform="translate(0)">
                                            <path id="Trazado_80" data-name="Trazado 80" d="M50.586,0H35.379a.344.344,0,0,0-.338.35V5.6h.676V.7H50.248V19.95a.34.34,0,0,1-.311.35c-.029,0-.058,0-.087,0-.06,0-.12,0-.178-.009a.037.037,0,0,1-.015,0,2.412,2.412,0,0,1-2.1-2.17.115.115,0,0,0,0-.015q-.012-.125-.012-.25v-.7a.344.344,0,0,0-.338-.35H35.717V10.5h-.676v6.3h-2.7a.344.344,0,0,0-.338.35v.7A3.1,3.1,0,0,0,35.041,21h14.9a1.026,1.026,0,0,0,.98-1.05V.35A.344.344,0,0,0,50.586,0ZM35.041,20.3a2.412,2.412,0,0,1-2.365-2.45V17.5H46.869v.35a3.347,3.347,0,0,0,.019.345c0,.03.009.06.013.09.011.085.025.169.043.252.006.029.014.058.021.087.021.084.044.167.071.249.008.023.016.047.024.07.031.087.066.172.1.255.008.017.016.035.024.051q.064.133.14.259l.02.035q.083.134.178.259l.011.015a3.192,3.192,0,0,0,.237.274A3.017,3.017,0,0,0,48,20.3Z" transform="translate(-28.841)"/>
                                            <path id="Trazado_81" data-name="Trazado 81" d="M11.55,3.5a.35.35,0,0,0,.247-.1L13.2,2a.35.35,0,0,0,0-.495L11.8.1A.35.35,0,0,0,11.55,0H1.75a1.75,1.75,0,1,0,0,3.5ZM11.46.755l1,1-1,1-.249-1ZM2.8.7h7.952l-.175.7H3.5v.7h7.077l.175.7H2.8ZM.7,1.75A1.05,1.05,0,0,1,1.75.7H2.1V2.8H1.75A1.05,1.05,0,0,1,.7,1.75Z" transform="translate(0 8.439) rotate(-20)"/>
                                            <path id="Trazado_82" data-name="Trazado 82" d="M176.352,99.2h10.5a.35.35,0,0,0,.35-.35v-10.5a.35.35,0,0,0-.6-.247L176.1,98.6a.35.35,0,0,0,.247.6ZM186.5,89.2V90.1h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7V95h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H183v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H177.2Z" transform="translate(-167.219 -84.152)"/>
                                            <path id="Trazado_83" data-name="Trazado 83" d="M292.232,207.912h3.33a.35.35,0,0,0,.35-.35v-3.33a.35.35,0,0,0-.6-.247l-3.33,3.33a.35.35,0,0,0,.247.6Zm2.98-2.835v2.135h-2.135Z" transform="translate(-278.029 -194.962)"/>
                                            <rect id="Rectángulo_542" data-name="Rectángulo 542" width="7" height="1" transform="translate(10.455 2)"/>
                                            <rect id="Rectángulo_543" data-name="Rectángulo 543" width="9" transform="translate(9.455 4)"/>
                                        </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[1]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[1]->id])  : '#'}}" class="underline text-gray-900 dark:text-white">{{ isset($node->shuffleProjects[1]) ? $node->shuffleProjects[1]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{ isset($node->shuffleProjects[1]) ? substr($node->shuffleProjects[1]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.083" height="21" viewBox="0 0 22.083 21">
                                    <g id="project" transform="translate(13.455)">
                                        <g id="Grupo_2813" data-name="Grupo 2813" transform="translate(-13.455)">
                                        <g id="Grupo_2812" data-name="Grupo 2812" transform="translate(0)">
                                            <path id="Trazado_80" data-name="Trazado 80" d="M50.586,0H35.379a.344.344,0,0,0-.338.35V5.6h.676V.7H50.248V19.95a.34.34,0,0,1-.311.35c-.029,0-.058,0-.087,0-.06,0-.12,0-.178-.009a.037.037,0,0,1-.015,0,2.412,2.412,0,0,1-2.1-2.17.115.115,0,0,0,0-.015q-.012-.125-.012-.25v-.7a.344.344,0,0,0-.338-.35H35.717V10.5h-.676v6.3h-2.7a.344.344,0,0,0-.338.35v.7A3.1,3.1,0,0,0,35.041,21h14.9a1.026,1.026,0,0,0,.98-1.05V.35A.344.344,0,0,0,50.586,0ZM35.041,20.3a2.412,2.412,0,0,1-2.365-2.45V17.5H46.869v.35a3.347,3.347,0,0,0,.019.345c0,.03.009.06.013.09.011.085.025.169.043.252.006.029.014.058.021.087.021.084.044.167.071.249.008.023.016.047.024.07.031.087.066.172.1.255.008.017.016.035.024.051q.064.133.14.259l.02.035q.083.134.178.259l.011.015a3.192,3.192,0,0,0,.237.274A3.017,3.017,0,0,0,48,20.3Z" transform="translate(-28.841)"/>
                                            <path id="Trazado_81" data-name="Trazado 81" d="M11.55,3.5a.35.35,0,0,0,.247-.1L13.2,2a.35.35,0,0,0,0-.495L11.8.1A.35.35,0,0,0,11.55,0H1.75a1.75,1.75,0,1,0,0,3.5ZM11.46.755l1,1-1,1-.249-1ZM2.8.7h7.952l-.175.7H3.5v.7h7.077l.175.7H2.8ZM.7,1.75A1.05,1.05,0,0,1,1.75.7H2.1V2.8H1.75A1.05,1.05,0,0,1,.7,1.75Z" transform="translate(0 8.439) rotate(-20)"/>
                                            <path id="Trazado_82" data-name="Trazado 82" d="M176.352,99.2h10.5a.35.35,0,0,0,.35-.35v-10.5a.35.35,0,0,0-.6-.247L176.1,98.6a.35.35,0,0,0,.247.6ZM186.5,89.2V90.1h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7V95h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H183v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H177.2Z" transform="translate(-167.219 -84.152)"/>
                                            <path id="Trazado_83" data-name="Trazado 83" d="M292.232,207.912h3.33a.35.35,0,0,0,.35-.35v-3.33a.35.35,0,0,0-.6-.247l-3.33,3.33a.35.35,0,0,0,.247.6Zm2.98-2.835v2.135h-2.135Z" transform="translate(-278.029 -194.962)"/>
                                            <rect id="Rectángulo_542" data-name="Rectángulo 542" width="7" height="1" transform="translate(10.455 2)"/>
                                            <rect id="Rectángulo_543" data-name="Rectángulo 543" width="9" transform="translate(9.455 4)"/>
                                        </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[2]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[2]->id])  : '#'}}" class="underline text-gray-900 dark:text-white">{{ isset($node->shuffleProjects[2]) ? $node->shuffleProjects[2]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    {{ isset($node->shuffleProjects[2]) ? substr($node->shuffleProjects[2]->abstract, 0, 250).'...' : __('No data recorded') }}
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22.083" height="21" viewBox="0 0 22.083 21">
                                    <g id="project" transform="translate(13.455)">
                                        <g id="Grupo_2813" data-name="Grupo 2813" transform="translate(-13.455)">
                                        <g id="Grupo_2812" data-name="Grupo 2812" transform="translate(0)">
                                            <path id="Trazado_80" data-name="Trazado 80" d="M50.586,0H35.379a.344.344,0,0,0-.338.35V5.6h.676V.7H50.248V19.95a.34.34,0,0,1-.311.35c-.029,0-.058,0-.087,0-.06,0-.12,0-.178-.009a.037.037,0,0,1-.015,0,2.412,2.412,0,0,1-2.1-2.17.115.115,0,0,0,0-.015q-.012-.125-.012-.25v-.7a.344.344,0,0,0-.338-.35H35.717V10.5h-.676v6.3h-2.7a.344.344,0,0,0-.338.35v.7A3.1,3.1,0,0,0,35.041,21h14.9a1.026,1.026,0,0,0,.98-1.05V.35A.344.344,0,0,0,50.586,0ZM35.041,20.3a2.412,2.412,0,0,1-2.365-2.45V17.5H46.869v.35a3.347,3.347,0,0,0,.019.345c0,.03.009.06.013.09.011.085.025.169.043.252.006.029.014.058.021.087.021.084.044.167.071.249.008.023.016.047.024.07.031.087.066.172.1.255.008.017.016.035.024.051q.064.133.14.259l.02.035q.083.134.178.259l.011.015a3.192,3.192,0,0,0,.237.274A3.017,3.017,0,0,0,48,20.3Z" transform="translate(-28.841)"/>
                                            <path id="Trazado_81" data-name="Trazado 81" d="M11.55,3.5a.35.35,0,0,0,.247-.1L13.2,2a.35.35,0,0,0,0-.495L11.8.1A.35.35,0,0,0,11.55,0H1.75a1.75,1.75,0,1,0,0,3.5ZM11.46.755l1,1-1,1-.249-1ZM2.8.7h7.952l-.175.7H3.5v.7h7.077l.175.7H2.8ZM.7,1.75A1.05,1.05,0,0,1,1.75.7H2.1V2.8H1.75A1.05,1.05,0,0,1,.7,1.75Z" transform="translate(0 8.439) rotate(-20)"/>
                                            <path id="Trazado_82" data-name="Trazado 82" d="M176.352,99.2h10.5a.35.35,0,0,0,.35-.35v-10.5a.35.35,0,0,0-.6-.247L176.1,98.6a.35.35,0,0,0,.247.6ZM186.5,89.2V90.1h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7V95h.7v.7h-.7v.7h.7v.7h-.7v.7h.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H183v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7h-.7v-.7h-.7v.7H177.2Z" transform="translate(-167.219 -84.152)"/>
                                            <path id="Trazado_83" data-name="Trazado 83" d="M292.232,207.912h3.33a.35.35,0,0,0,.35-.35v-3.33a.35.35,0,0,0-.6-.247l-3.33,3.33a.35.35,0,0,0,.247.6Zm2.98-2.835v2.135h-2.135Z" transform="translate(-278.029 -194.962)"/>
                                            <rect id="Rectángulo_542" data-name="Rectángulo 542" width="7" height="1" transform="translate(10.455 2)"/>
                                            <rect id="Rectángulo_543" data-name="Rectángulo 543" width="9" transform="translate(9.455 4)"/>
                                        </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="{{ isset($node->shuffleProjects[3]) ? route('nodes.explorer.searchProjects.showProject', [$node, $node->shuffleProjects[3]->id])  : '#'}}" class="underline text-gray-900 dark:text-white">{{ isset($node->shuffleProjects[3]) ? $node->shuffleProjects[3]->title  : __('No data recorded') }}</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
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
    </div>
    <div class="p-6 mt-40">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden text-center mb-8">
                <h1 class="text-xl md:text-4xl text-gray-400 leading-10">#EventosRREDSI<strong>Caldas{{ date('Y') }}</strong></h1>
                <p class="text-gray-800 leading-10">Consulte los eventos <strong>{{ date('Y') }}</strong> de las diferentes instituciones educativas, inscriba sus proyectos y divulgue los resultados.</p>
                <a href="{{ route('nodes.explorer.events', [$node]) }}" class="mt-4 active:bg-blue-900 bg-blue-900 hover:bg-blue-900 text-white inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información de próximos eventos</a>
            </div>
        </div>
    </div>
    <div class="text-left px-4 md:px-0 bg-gray-100 h-64 p-0 md:p-11 md:pl-1/6 shadow" style="background: #f7f7f7 url(/storage/images/dots.png);background-size: cover;background-position: right;background-repeat: no-repeat;">
        <h1 class="text-2xl md:text-4xl text-gray-900 leading-10">XII Encuentro departamental de semilleros de investigación <span class="capitalize">{{ $node->state }}</span></h1>
        <p class="leading-10">Del 18 al 19 de agosto de {{ date('Y') }}</p>
        <a href="{{ route('nodes.explorer.events.rredsiEventRegister', [$node]) }}" class="mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="h-auto md:h-64 bg-cool-gray-600 p-9 md:p-11" style="background: #475569 url(/storage/images/rectangles.png); background-repeat: no-repeat; background-position: 400px; background-blend-mode: color-burn;">
            <h1 class="text-2xl md:text-4xl text-gray-300 leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[0]) ? $node->shuffleEducationalInstitutionEvents[0]->name : __('No data recorded') }}</h1>
            <p class="text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[0]) ? $node->shuffleEducationalInstitutionEvents[0]->datesForHumans : __('No data recorded') }}</p>
            <a href="{{ route('nodes.explorer.showEvent', [$node, $node->shuffleEducationalInstitutionEvents[0]->id]) }}" class="mt-1 md:mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-1 md:px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
        </div>
        <div class="h-auto md:h-64 bg-cool-gray-700 p-9 md:p-11">
            <h1 class="text-2xl md:text-4xl text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[1]) ? $node->shuffleEducationalInstitutionEvents[1]->name : __('No data recorded') }}</h1>
            <p class="text-white leading-10">{{ isset($node->shuffleEducationalInstitutionEvents[1]) ? $node->shuffleEducationalInstitutionEvents[1]->datesForHumans : __('No data recorded') }}</p>
            <a href="{{ route('nodes.explorer.showEvent', [$node, $node->shuffleEducationalInstitutionEvents[1]->id]) }}" class="mt-1 md:mt-4 active:bg-white bg-white hover:bg-white text-gray-400 inline-flex items-center px-1 md:px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Más información</a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 dark:bg-gray-800 overflow-hidden">
            <figure class="mt-24 mb-24">
                <img src="{{ url("storage/images/logos.png") }}">
            </figure>
        </div>
    </div>

    <x-footer />

</x-guest-layout>
