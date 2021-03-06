<title>{{'Crear proyecto'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-1 col-span-5 ml-5 md:ml-0 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Projects') }}
                <span class="text-base sm:text-lg block text-purple-300">
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}" class="text-white font-weight underline">Lista de proyectos</a> / Crear proyecto
                </span>
            </h2>
        </div>
        {{-- @can('index_project')
        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                {{ __('Back')}}
            </div>
        </a>
        @endcan --}}
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Crear un proyecto de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.store', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}" enctype="multipart/form-data" id="create-project">
                    @csrf

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="principal_research_team_id" value="{{ __('Principal research team') }}" />
                        <select id="principal_research_team_id" name="principal_research_team_id" class="form-select w-full" required >
                            <option value="">Seleccione un semillero de investigación principal</option>
                            @foreach ($educationalInstitutionFacultyResearchTeams as $educationalInstitutionFacultyResearchTeam)
                                <option {{ old('principal_research_team_id') == $educationalInstitutionFacultyResearchTeam->id ? "selected" : ""  }} value="{{ $educationalInstitutionFacultyResearchTeam->id }}">{{ $educationalInstitutionFacultyResearchTeam->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="principal_research_team_id" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="project_type_id" value="{{ __('Project type') }}" />
                        <select id="project_type_id" name="project_type_id" class="form-select w-full" required >
                            <option value="">Seleccione un tipo de proyecto</option>
                            @forelse ($projectTypes as $projectType)
                                <option value="{{ $projectType->id }}" {{ old('project_type_id') == $projectType->id ? "selected" : "" }}>{{ $projectType->type }}</option>
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_type_id" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="main_image" value="{{ __('Main image') }}" />
                        <x-jet-input id="main_image" class="block mt-1 w-full overflow-hidden" type="file" accept="image/*" name="main_image" value="{{ old('main_image') }}" />
                        <x-jet-input-error for="main_image" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="title" value="{{ __('Title') }}" />
                        <textarea rows="20" id="title" name="title" max="255" class="form-textarea border-0 w-full" rows="8" required >{{ old('title') }}</textarea>
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="start_date" value="{{ __('Start date') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="start_date" value="{{ old('start_date') }}" required />
                        <x-jet-input-error for="start_date" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="end_date" value="{{ __('End date') }}" />
                        <x-jet-input id="end_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="end_date" value="{{ old('end_date') }}" required />
                        <x-jet-input-error for="end_date" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="abstract" value="{{ __('Abstract') }}" />
                        <textarea rows="20" id="abstract" name="abstract" class="form-textarea border-0 w-full" rows="8" required >{{ old('abstract') }}</textarea>
                        <x-jet-input-error for="abstract" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="overall_objective" value="{{ __('Overall objective') }}" />
                        <textarea rows="20" id="overall_objective" name="overall_objective" class="form-textarea border-0 w-full" rows="8" required >{{ old('overall_objective') }}</textarea>
                        <x-jet-input-error for="overall_objective" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="keywords" value="{{ __('Keywords') }}" />
                        <small class="inline-block text-gray-500">Separe con comas cada palabra clave</small>
                        <textarea rows="20" id="keywords" name="keywords" class="form-textarea border-0 w-full" rows="8" required >{{ old('keywords') }}</textarea>
                        <x-jet-input-error for="keywords" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="roles_requirements_description" value="{{ __('Roles requirements description') }}" />
                        <textarea rows="20" id="roles_requirements_description" name="roles_requirements_description" class="form-textarea border-0 w-full" rows="8" >{{ old('roles_requirements_description') }}</textarea>
                        <x-jet-input-error for="roles_requirements_description" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="roles_requirements" value="{{ __('Roles requirements') }}" />
                        <small class="inline-block text-gray-500">Separe con comas cada requerimiento de rol</small>
                        <textarea rows="20" id="roles_requirements" name="roles_requirements" class="form-textarea border-0 w-full" rows="8" >{{ old('roles_requirements') }}</textarea>
                        <x-jet-input-error for="roles_requirements" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="tools_requirements_description" value="{{ __('Tools requirements description') }}" />
                        <textarea rows="20" id="tools_requirements_description" name="tools_requirements_description" class="form-textarea border-0 w-full" rows="8" >{{ old('tools_requirements_description') }}</textarea>
                        <x-jet-input-error for="tools_requirements_description" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="tools_requirements" value="{{ __('Tools requirements') }}" />
                        <small class="inline-block text-gray-500">Separe con comas cada requerimiento de herramienta / equipo</small>
                        <textarea rows="20" id="tools_requirements" name="tools_requirements" class="form-textarea border-0 w-full" rows="8" >{{ old('tools_requirements') }}</textarea>
                        <x-jet-input-error for="tools_requirements" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="file" value="{{ __('File') }}" />
                        <x-jet-input id="file" class="block mt-1 w-full overflow-hidden" type="file" accept="application/pdf" name="file" value="{{ old('file') }}" />
                        <x-jet-input-error for="file" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Is privated?') }} </p>
                    <div class="block mt-4">
                        <label for="is_privated_yes" class="flex items-center">
                            <input id="is_privated_yes" value="1" type="radio" class="form-radio" name="is_privated" {{ old('is_privated') == 1 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_privated_no" class="flex items-center">
                            <input id="is_privated_no" value="0" type="radio" class="form-radio" name="is_privated" {{ old('is_privated') != null && old('is_privated')  == 0 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_privated" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Is published?') }} </p>
                    <div class="block mt-4">
                        <label for="is_published_yes" class="flex items-center">
                            <input id="is_published_yes" value="1" type="radio" class="form-radio" name="is_published" {{ old('is_published') == 1 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_published_no" class="flex items-center">
                            <input id="is_published_no" value="0" type="radio" class="form-radio" name="is_published" {{ old('is_published') != null && old('is_published') == 0 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_published" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p>{{ __('Authors') }}</p>
                        @forelse ($authors as $author)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="user_id[]" @if(is_array(old('user_id')) && in_array($author->id, old('user_id'))) checked @endif id="{{ "author-$author->id" }}" value="{{ $author->id }}" />
                                <label  label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "author-$author->id" }}">{{ $author->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="user_id" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p>{{ __('Academic programs') }} asociados</p>
                        @forelse ($academicPrograms as $academicProgram)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="academic_program_id[]" @if(is_array(old('academic_program_id')) && in_array($academicProgram->id , old('academic_program_id'))) checked @endif id="{{ "academic-program-$academicProgram->id" }}" value="{{ $academicProgram->id }}" />
                                <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "academic-program-$academicProgram->id" }}">{{ $academicProgram->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="academic_program_id" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p>{{ __('Research lines') }} asociadas</p>
                        @forelse ($researchLines as $researchLine)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="research_line_id[]" @if(is_array(old('research_line_id')) && in_array($researchLine->id , old('research_line_id'))) checked @endif id="{{ "research-line-$researchLine->id" }}" value="{{ $researchLine->id }}" />
                                <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "research-line-$researchLine->id" }}">{{ $researchLine->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="research_line_id" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p>{{ __('Research teams') }} asociados</p>
                        @forelse ($researchTeams as $researchTeam)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="research_team_id[]"  @if(is_array(old('research_team_id')) && in_array($researchTeam->id , old('research_team_id'))) checked @endif id="{{ "research-team-$researchTeam->id" }}" value="{{ $researchTeam->id }}" />
                                <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "research-team-$researchTeam->id" }}">{{ $researchTeam->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="research_team_id" class="mt-2" />
                    </div>

                    <hr class="mt-1/6 mb-1/6">

                    <p>A continuación, debe seleccionar una o varias disciplinas de subáreas de conocimiento. Diríjase a la área de conocimiento y luego de clic en una subárea de conocimiento para que se listen las disciplinas.</p>

                    <x-checkbox-knowledge-subarea-discipline :knowledgeAreas="$knowledgeAreas" :model="null" />

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button id="modal-open" type="button" class="ml-4 modal-open">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     {{-- #Component modal --}}
    <x-dialog-modal>
        <x-slot name="title">
            El trabajo que desea enviar tiene seleccionada la opción de 'Privacidad del proyecto' <span class="project-privacy"></span>, por favor lea atentamente la siguiente información y confirme si está de acuerdo o no.
        </x-slot>
        <x-slot name="body">
            <p class="project-privacy-activated text-sm text-gray-500">
                Al cargar un trabajo de manera pública en la plataforma {{ config('app.name') }}, usted nos otorga el derecho para publicar, poner a disposición, enlazar y utilizar dicho trabajo en medios (ya sean conocidos o desarrollados posteriormente por la Red Regional de Semilleros de Investigación). No podrá realizar ningún envío de forma anónima, así ​​garantiza y declara que dicho trabajo es original y ha sido escrito por usted.
            </p>
            <p class="text-sm text-gray-500">
                El trabajo que usted intenta cargar a la plataforma será revisado en algún momento por el delegado de su institución educativa y de ser pertinente podrá ser eliminado a criterio. Al publicar dicho trabajo, también garantiza y declara que posee o controla todos los derechos de su trabajo, incluidos, entre otros, todos los derechos necesarios para otorgar el permiso especificado anteriormente.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                No puede utilizar los servicios de la plataforma {{ config('app.name') }} para publicar o distribuir información que sea ilegal, que viole o infrinja los derechos de cualquier otra persona, que sea difamatoria, abusiva, odiosa, profana, pornográfica, amenazante o vulgar, que contiene errores, virus u otros componentes dañinos, o que de otro modo sea procesable por ley. {{ config('app.name') }} puede en cualquier momento ejercer control editorial sobre el contenido de los trabajos.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Tendremos el derecho de monitorear los trabajos para determinar el cumplimiento de estos Términos y Condiciones y cualquier regla operativa que establezcamos y para satisfacer cualquier ley, reglamento o solicitud gubernamental autorizada. Tendremos el derecho, a nuestro exclusivo criterio, de editar, negarnos a publicar o eliminar cualquier trabajo.
            </p>
            <p class="project-privacy-activated text-sm mt-2 text-red-700">
                Importante: si el trabajo está en proceso de ser una patente, invención o modelo de utilidad se recomienda no ser enviado a la plataforma o debe tener la opción 'Privacidad del proyecto' en 'activada'.
            </p>
        </x-slot>

        <x-slot name="footer">
            <button class="modal-close mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">No estoy de acuerdo</button>
            <button form="create-project" class="modal-close w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">De acuerdo</button>
        </x-slot>
    </x-dialog-modal>

    @push('scripts')
        <script>
            document.addEventListener(
                "DOMContentLoaded",
                function() {
                    document.getElementById('modal-open').onclick = function(event)
                    {
                        var privated_yes = document.getElementById('is_privated_yes');
                        var privated_no  = document.getElementById('is_privated_no');
                        var project_privacy_activated = document.getElementsByClassName('project-privacy-activated');

                        if (privated_yes.checked) {
                            document.querySelector('.project-privacy').innerHTML = 'activada';

                            for (const iterator of project_privacy_activated) {
                                iterator.classList.add('block');
                                iterator.classList.remove('hidden');
                            }

                        } else if (privated_no.checked) {

                            for (const iterator of project_privacy_activated) {
                                iterator.classList.add('hidden');
                                iterator.classList.remove('block');
                            }

                            document.querySelector('.project-privacy').innerHTML = 'desactivada';
                        }
                    }
                }, false
            )
        </script>
    @endpush


    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
