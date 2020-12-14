<x-app-layout>

    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ $educationalInstitution->name }}
            <span class="sm:block text-purple-300">
                
            </span>
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="container mx-auto">
            <h1 class="text-3xl mb-4">{{ __('Business Analytics') }}</h1>
            <div class="grid md:grid-cols-3 gap-4">

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">    
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyAcademicPrograms() }} programa(s) de formación</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Academic programs') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">    
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyResearchGroups() }} grupo(s) de investigación</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Research groups') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">    
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyEducationalEnvironments() }} ambiente(s) de formación</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Educational environments') }}</h1>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="grid md:grid-cols-3 gap-4">

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyEvents() }} evento(s)</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Events') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyUsers() }} usuario(s)</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Users') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyGraduationsInfo() }} usuario(s) con información académica registrada</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Graduations') }}</h1>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div class="grid md:grid-cols-3 gap-4">

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyResearchTeams() }} semillero(s) de investigación</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Research teams') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyProjects() }} proyectos(s) registrados</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Projects') }}</h1>
                    </div>
                </div>

                <div class="h-64 bg-white overflow-hidden shadow-xl sm-rounded-lg p-4 flex">
                    <div class="flex flex-col h-56 items-center justify-around w-full">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-14 w-14 rounded-full bg-indigo-200 sm:mx-0 sm:h-14 sm:w-14">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10 h-10 text-blue-800">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h1 class="text-gray-400">{{ $educationalInstitution->qtyResearchOutputs() }} producto(s)</h1>
                        <h1 class="text-2xl text-gray-400">{{ __('Research outputs') }}</h1>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <div id="projectsByProjectTypes" class="mx-auto" style="width: 1023px; height: 400px;"></div>

            <x-jet-section-border />

            <div id="projectsByKnowledgeArea" class="mx-auto" style="width: 1023px; height: 400px;"></div>

            <x-jet-section-border />

            <div id="projectsByYear" class="mx-auto" style="width: 1023px; height: 500px"></div>

            <x-jet-section-border />

            <div id="eventsAndProjects" class="mx-auto" style="width: 1023px; height: 500px"></div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {packages:['corechart']});

            var EventsAndProjects = (function() {
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var options = {
                        title: 'Cantidad de proyectos registrados en eventos',
                        width: 1023,
                        height: 400,
                        bar: { groupWidth: '95%' },
                        legend: { position: 'none' },
                        vAxis: { format: ' ' },
                        animation: {
                            duration: 1500,
                            startup: true
                        }
                    };
                    var data = google.visualization.arrayToDataTable([
                        ["Element", "Cantidad", { role: "style" } ],
                        @foreach ($educationalInstitution->eventsAndProjects as $event)
                            ["{{ preg_replace('/\r|\n/', "", $event->name) }}", {{ $event->count }}, "color: #e5e4e2"],
                        @endforeach
                    ]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                                    { calc: 'stringify',
                                        sourceColumn: 1,
                                        type: 'string',
                                        role: 'annotation' },
                                    2]);

                    var chart = new google.visualization.ColumnChart(document.getElementById('eventsAndProjects'));
                    chart.draw(view, options);
                }
            })();
            
            var ProjectsByKnowledgeArea = (function() {
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var options = {
                        title: 'Proyectos por área de conocimiento',
                        width: 1023,
                        height: 400,
                        bar: { groupWidth: '95%' },
                        legend: { position: 'none' },
                        vAxis: { format: ' ' },
                        animation: {
                            duration: 1500,
                            startup: true
                        }
                    };
                    var data = google.visualization.arrayToDataTable([
                        ['Element', 'Cantidad', { role: 'style' } ],
                        ['Industrias creativas', {{ $educationalInstitution->projectsByKnowledgeArea['industriasCreativas'] }}, "color: #e5e4e2"],
                        ['Ciencias naturales', {{ $educationalInstitution->projectsByKnowledgeArea['cienciasNaturales'] }}, "color: #e5e4e2"],
                        ['Ingeniería y tecnología', {{ $educationalInstitution->projectsByKnowledgeArea['ingenieriaTecnologia'] }}, "color: #e5e4e2"],
                        ['Cuarta revolución industrial', {{ $educationalInstitution->projectsByKnowledgeArea['cuartaRevolucionIndustrial'] }}, "color: #e5e4e2"],
                        ['Ciencias médicas y de salud', {{ $educationalInstitution->projectsByKnowledgeArea['cienciasMedicasSalud'] }}, "color: #e5e4e2"],
                        ['Ciencias agrícolas', {{ $educationalInstitution->projectsByKnowledgeArea['cienciasAgricolas'] }}, "color: #e5e4e2"],
                        ['Ciencias veterinarias', {{ $educationalInstitution->projectsByKnowledgeArea['cienciasVeterinarias'] }}, "color: #e5e4e2"],
                        ['Ciencias sociales', {{ $educationalInstitution->projectsByKnowledgeArea['cienciasSociales'] }}, "color: #e5e4e2"],
                        ['Humanidades', {{ $educationalInstitution->projectsByKnowledgeArea['humanidades'] }}, "color: #e5e4e2"],
                    ]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([0, 1,
                                    { calc: 'stringify',
                                        sourceColumn: 1,
                                        type: 'string',
                                        role: 'annotation' },
                                    2]);

                    var chart = new google.visualization.ColumnChart(document.getElementById('projectsByKnowledgeArea'));
                    chart.draw(view, options);
                }
            })();

            var ProjectsByProjectTypes = (function() {
                google.charts.setOnLoadCallback(drawChart);
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var options = {
                        title: 'Distribución por tipo de proyecto',
                        is3D: true,
                    };
                    var data = google.visualization.arrayToDataTable([
                        ['Tipo de proyecto', 'Cantidad'],
                        ['Investigación aplicada', {{ $educationalInstitution->projectsByProjectTypes['investigacionAplicada'] }}],
                        ['Investigación básica', {{ $educationalInstitution->projectsByProjectTypes['investigacionBasica'] }}],
                        ['Desarrollo tecnológico', {{ $educationalInstitution->projectsByProjectTypes['desarrolloTecnologico'] }}],
                    ]);

                    var chart = new google.visualization.PieChart(document.getElementById('projectsByProjectTypes'));
                    chart.draw(data, options);
                }
            })();

            var ProjectsByYear = (function() {
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var options = {
                        title: 'Proyectos registrados por año',
                        legend: { position: 'bottom' },
                        vAxis: { format: ' ' },
                        animation: {
                            duration: 1500,
                            startup: true
                        }
                    };
                    var data = google.visualization.arrayToDataTable([
                        ['Año', 'Proyectos registrados'],
                        @forelse ($educationalInstitution->projectsByYear->sortBy('date_part') as $projectByYear)
                            ["{{ $projectByYear->date_part }}",  {{ $projectByYear->count }}],
                        @empty
                            ["{{ date('Y') }}",  0],
                        @endforelse
                    ]);

                    var chart = new google.visualization.LineChart(document.getElementById('projectsByYear'));
                    chart.draw(data, options);
                }
            })();
        </script>
    @endpush
</x-app-layout>
