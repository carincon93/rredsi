<x-guest-layout>

    <x-guest-header :node="$node" image="images/node-info.jpg">
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
            XII Encuentro Departamental de semilleros de investigación de <span class="capitalize">{{ $node->state }}</span> {{ date('Y') }}
        </x-slot>
        <x-slot name="actionButton">
            
        </x-slot>
    </x-guest-header>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Añadir un evento</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.events.store', [$node]) }}">
                    @csrf

                    <div class="mt-1/12">
                        <x-jet-label for="presentation_type" value="{{ __('Presentation type') }}" />
                        <select id="presentation_type" name="presentation_type" class="form-select w-full" required >
                            <option value="">Seleccione el tipo de presentación</option>
                            <option {{ old('presentation_type') == "Ponencia oral" ? "selected" : ""  }} value="Ponencia oral">Ponencia oral</option>
                            <option {{ old('presentation_type') == "Póster (Propuestas de investigación)" ? "selected" : ""  }} value="Póster (Propuestas de investigación)">Póster (Propuestas de investigación)</option>
                        </select>
                        <x-jet-input-error for="presentation_type" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <x-jet-label for="proyect_type" value="{{ __('Project type') }}" />
                        <select id="proyect_type" name="proyect_type" class="form-select w-full" required >
                            <option value="">Seleccione el tipo de proyecto</option>
                            <option {{ old('proyect_type') == "Proyecto en curso" ? "selected" : ""  }} value="Proyecto en curso">Proyecto en curso</option>
                            <option {{ old('proyect_type') == "Proyecto terminado" ? "selected" : ""  }} value="Proyecto terminado">Proyecto terminado</option>
                            <option {{ old('proyect_type') == "Propuesta proyecto de investigación (Aplica solo para póster)" ? "selected" : ""  }} value="Propuesta proyecto de investigación (Aplica solo para póster)">Propuesta proyecto de investigación (Aplica solo para póster)</option>
                        </select>
                        <x-jet-input-error for="proyect_type" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <x-jet-label for="project_id" value="{{ __('Projects') }}" />
                        <select id="project_id" name="project_id" class="form-select w-full" required >
                            <option value="">Seleccione el proyecto</option>
                            @forelse ($projects as $project)
                                <option {{ old('project_id') == $project->id ? "selected" : ""  }} value="{{ $project->id }}">{{ $project->title }}</option>
                            @empty
                                <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_id" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <p>{{ __('Speakers') }}</p>
                        @forelse ($educationalInstitutionFacultiesUsers as $educationalInstitutionFaculty)
                            @forelse ($educationalInstitutionFaculty->members as $user)
                                <div class="mt-1/12">
                                    <input class="form-check-input" type="checkbox" name="user_id[]"  @if(is_array(old('user_id')) && in_array($user->id , old('user_id'))) checked @endif id="{{ "knowledge-area-$user->id" }}" value="{{ $user->id }}" />
                                    <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "knowledge-area-$user->id" }}">{{ $user->name }}</label>
                                </div>
                            @empty
                                <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                            @endforelse
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="user_id" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <p>{{ __('Knowledge areas') }}</p>
                        @forelse ($knowledgeAreas as $knowledgeArea)
                            <div class="mt-1/12">
                                <input class="form-check-input" type="checkbox" name="knowledge_area_id[]"  @if(is_array(old('knowledge_area_id')) && in_array($knowledgeArea->id , old('knowledge_area_id'))) checked @endif id="{{ "knowledge-area-$knowledgeArea->id" }}" value="{{ $knowledgeArea->id }}" />
                                <label label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "knowledge-area-$knowledgeArea->id" }}">{{ $knowledgeArea->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="knowledge_area_id" class="mt-2" />
                    </div>
                    
                    <div class="mt-1/12">
                        <x-jet-label for="academic_program_id" value="{{ __('Academic programs') }}" />
                        <select id="academic_program_id" name="academic_program_id" class="form-select w-full" required >
                            <option value="">Seleccione el programa de formación</option>
                            @forelse ($educationalInstitutionFacultiesacademicPrograms as $educationalInstitutionFaculty)
                                @forelse ($educationalInstitutionFaculty->academicPrograms as $academicProgram)
                                    <option {{ old('academic_program_id') == $academicProgram->id ? "selected" : ""  }} value="{{ $academicProgram->id }}">{{ $academicProgram->name }}</option>
                                @empty
                                    <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                                @endforelse
                            @empty
                                <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                            @endforelse
                        </select>
                        <x-jet-input-error for="academic_program_id" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <x-jet-label for="research_team_id" value="{{ __('Research teams') }}" />
                        <select id="research_team_id" name="research_team_id" class="form-select w-full" required >
                            <option value="">Seleccione el semillero de investigación</option>
                            @forelse ($researchTeams as $researchTeam)
                                <option {{ old('research_team_id') == $researchTeam->id ? "selected" : ""  }} value="{{ $researchTeam->id }}">{{ $researchTeam->name }}</option>
                            @empty
                                <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                            @endforelse
                        </select>
                        <x-jet-input-error for="research_team_id" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <p>
                            Adjunte en este espacio el archivo que corresponde a la carta de aval del tutor de su semillero (Ver punto 6 de la guía de Inscripción. El archivo debe ser PDF y su tamaño de debe sobrepasar los 500kb)
                        </p>
                        <x-jet-label for="endorsement_letter" value="{{ __('Endorsement letter') }}" />
                        <x-jet-input id="endorsement_letter" class="block mt-1 w-full" type="file" accept="application/pdf" name="endorsement_letter" value="{{ old('endorsement_letter') }}" />
                        <x-jet-input-error for="endorsement_letter" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <p>
                            Adjunte en este espacio el documento completo para la elaboración de las memorias (Ver punto 6 de la guía de Inscripción, El archivo debe ser PDF y su tamaño de debe sobrepasar los 500kb)
                        </p>
                        <x-jet-label for="research_doc" value="{{ __('Research doc') }}" />
                        <x-jet-input id="research_doc" class="block mt-1 w-full" type="file" accept="application/pdf" name="research_doc" value="{{ old('research_doc') }}" />
                        <x-jet-input-error for="research_doc" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Register event') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>