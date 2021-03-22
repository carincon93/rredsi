<title>{{"Detalles del proyecto $project->title - ".config('app.name') }}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-1 col-span-5 ml-5 md:ml-0 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Project') }}
                <span class="text-base sm:text-lg block text-purple-300">
                    @if( Auth::user()->hasRole(4) )
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.my-projects',[$node,$educationalInstitution,$faculty,$researchGroup,$researchTeam]) }}" class="text-white font-weight underline">Lista de proyectos</a> / Detalles del proyecto
                    @else
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}" class="text-white font-weight underline">Lista de proyectos</a> / Detalles del proyecto
                    @endif
                </span>
            </h2>
        </div>
        @can('edit_project')
        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.edit', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project]) }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Edit project') }}
            </div>
        </a>
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 md:py-10 sm:px-6 lg:px-8">
            <div class="flex flex-wrap" id="tabs-id">
                <div class="w-full">
                    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-blue-900" onclick="changeActiveTab(event,'tab-profile')">
                                {{ __('Project') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-settings')">
                                {{ __('Research outputs') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-options')">
                                {{ __('Knowledge subarea disciplines') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-projects')">
                                {{ __('Events') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-researchLines')">
                                {{ __('Research lines') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-researchTeams')">
                                {{ __('Research teams') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-academicPrograms')">
                                {{ __('Academic programs') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-authors')">
                                {{ __('Authors') }}
                            </a>
                        </li>
                    </ul>


                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">

                            <div class="block" id="tab-profile">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div>
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Project type') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ optional($project->projectType)->type }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                                <h3 class="text-lg font-medium mt-2 md:mt-0 text-gray-900">Información del proyecto</h3>
                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Title') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Start date') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->start_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('End date') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->end_date }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Abstract') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->abstract }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('File') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <a href="{{ url("/storage/$project->file") }}" target="_blank" download>
                                                            Descargar archivo
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Keywords') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->keywords }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Overall objective') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $project->overall_objective }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Is published?') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            @if ($project->is_published)
                                                            {{'Yes' }}
                                                            @else
                                                            {{ 'No' }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>

                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div>

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Is privated?') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            @if ($project->is_privated)
                                                            {{'Yes' }}
                                                            @else
                                                            {{ 'No'}}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden" id="tab-settings">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de <br> productos de investigación</h3>
                                        </div>
                                        @foreach ($project->researchOutputs as $researchOutput)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Title') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $researchOutput->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-options">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de <br> las disciplinas de sub-área de conocimiento</h3>
                                        </div>

                                        @foreach ($project->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $knowledgeSubareaDiscipline->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-projects">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de los eventos</h3>
                                        </div>
                                        @foreach ($project->events as $event)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $event->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-researchLines">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de las líneas de investigación</h3>
                                        </div>

                                        @foreach ($project->researchLines as $researchLine)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $researchLine->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                            <div class="hidden" id="tab-researchTeams">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de los semilleros de investigación</h3>
                                        </div>

                                        @foreach ($project->researchTeams as $researchTeam)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $researchTeam->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-academicPrograms">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de los programas académicos</h3>
                                        </div>

                                        @foreach ($project->academicPrograms as $academicProgram)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $academicProgram->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="hidden" id="tab-authors">
                                <div>
                                    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                        <div class="md:col-span-1">
                                            <h3 class="text-lg font-medium text-gray-900">Información de los autores</h3>
                                        </div>

                                        @foreach ($project->authors as $author)
                                        <div class="md:grid md:grid-cols-2 md:gap-4">
                                            <div class="md:col-span-1">

                                            </div>
                                            <div class="mt-5 md:mt-0 md:col-span-2">
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $author->name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="hidden sm:block">
                                            <div class="py-8">
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
