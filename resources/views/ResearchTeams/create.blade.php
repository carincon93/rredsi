<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Crear equipos de investigación
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                        <form method="POST" action={{ route('research-teams.store')}} >
                            @csrf

                            <div class="form-group">
                                <label for="name">Nombre del semillero</label>
                                <small id="nameHelp" class="form-text text-muted">Campo requerido</small>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    aria-describedby="nameHelp"
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="mentor_name">Nombre del tutor</label>
                                <small id="mentor_nameHelp" class="form-text text-muted">Campo requerido</small>
                                <input
                                    type="text"
                                    name="mentor_name"
                                    id="mentor_name"
                                    class="form-control"
                                    aria-describedby="mentor_nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.mentor_name.message ? rules.mentor_name.message : requestValidation.mentor_name ? requestValidation.mentor_name : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="mentor_email">Correo electrónico del tutor</label>
                                <small id="mentor_emailHelp" class="form-text text-muted">Campo requerido</small>
                                <input
                                    type="email"
                                    name="mentor_email"
                                    id="mentor_email"
                                    class="form-control"
                                    aria-describedby="mentor_emailHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.mentor_email.message ? rules.mentor_email.message : requestValidation.mentor_email ? requestValidation.email : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="mentor_cellphone">Número de celular del tutor</label>
                                <small id="mentor_cellphoneHelp" class="form-text text-muted">Campo requerido</small>
                                <input
                                    type="number"
                                    name="mentor_cellphone"
                                    id="mentor_cellphone"
                                    class="form-control"
                                    aria-describedby="mentor_cellphoneHelp"
                                    min="0"
                                    max=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.mentor_cellphone.message ? rules.mentor_cellphone.message : requestValidation.mentor_cellphone ? requestValidation.mentor_cellphone : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="overall_objective">Objetivo general</label>
                                <small id="overall_objectiveHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="overall_objective"
                                    id="overall_objective"
                                    aria-describedby="overall_objectiveHelp"
                                    class="form-control"
                                    required
                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.overall_objective.message ? rules.overall_objective.message : requestValidation.overall_objective ? requestValidation.overall_objective : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="mission">Misión</label>
                                <small id="missionHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="mission"
                                    id="mission"
                                    aria-describedby="missionHelp"
                                    class="form-control"
                                    required
                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.mission.message ? rules.mission.message : requestValidation.mission ? requestValidation.mission : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="vision">Visión</label>
                                <small id="visionHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="vision"
                                    id="vision"
                                    aria-describedby="visionHelp"
                                    class="form-control"
                                    required
                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.vision.message ? rules.vision.message : requestValidation.vision ? requestValidation.vision : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="regional_projection">Proyección regional y comunitaria</label>
                                <small id="regional_projectionHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="regional_projection"
                                    id="regional_projection"
                                    aria-describedby="regional_projectionHelp"
                                    class="form-control"
                                    required
                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.regional_projection.message ? rules.regional_projection.message : requestValidation.regional_projection ? requestValidation.regional_projection : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="knowledge_production_strategy">Estrategia de producción de conocimiento</label>
                                <small id="knowledge_production_strategyHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="knowledge_production_strategy"
                                    id="knowledge_production_strategy"
                                    aria-describedby="knowledge_production_strategyHelp"
                                    class="form-control"
                                    required


                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.knowledge_production_strategy.message ? rules.knowledge_production_strategy.message : requestValidation.knowledge_production_strategy ? requestValidation.knowledge_production_strategy : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="creation_date">Fecha de creación</label>
                                <small id="creation_dateHelp" class="form-text text-muted">Campo requerido</small>
                                <input
                                    type="date"
                                    id="creation_date"
                                    name="creation_date"
                                    class="form-control"
                                    aria-describedby="creation_dateHelp"
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.creation_date.message ? rules.creation_date.message : requestValidation.creation_date ? requestValidation.creation_date : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Áreas de conocimiento</label>
                                <small id="knowledge_area_idHelp" class="form-text text-muted">Campo requerido</small>

                                @forelse ($knowledgeAreas as $knowledgeArea)
                                    <div class="form-check ml-2">
                                        <input
                                            type="checkbox"
                                            id={{ $knowledgeArea->name }}
                                            name="knowledge_area_id[]"
                                            aria-describedby="knowledge_area_idHelp"
                                            value={{ $knowledgeArea->id }}
                                            class="form-check-input"
                                        />
                                        <label class="form-check-label" for={{ $knowledgeArea->name }}>
                                            {{ $knowledgeArea->name }}
                                        </label>
                                    </div>
                                @empty
                                    <div>No knowledge areas</div>
                                @endforelse

                                {{-- <span class={rules.knowledge_area_id.isInvalid && rules.knowledge_area_id.message !== '' || requestValidation.knowledge_area_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                    {rules.knowledge_area_id.message ? rules.knowledge_area_id.message : requestValidation.knowledge_area_id ? requestValidation.knowledge_area_id : '' }
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="educational_institution_id">Institución educativa</label>
                                <small id="educational_institution_idHelp" class="form-text text-muted">Campo requerido</small>
                                <select
                                    name="educational_institution_id"
                                    id="educational_institution_id"
                                    class="form-control"
                                    aria-describedby="educational_institution_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione una Institución educativa</option>

                                    @forelse ($educationalInstitutions as $educationalInstitution)
                                        <option value={{ $educationalInstitution->id }} >{{ $educationalInstitution->name }}</option>
                                    @empty
                                        <option value=''>No educational institutions</option>
                                    @endforelse

                                </select>
                                <span class="invalid-feedback">
                                    {{-- {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Programas de formación</label>
                                <small id="academic_program_idHelp" class="form-text text-muted">Campo requerido</small>

                                @forelse ($academicPrograms as $academicProgram)
                                    <div class="form-check ml-2">
                                        <input
                                            type="checkbox"
                                            name="academic_program_id[]"
                                            id={{ $academicProgram->name }}
                                            class="form-check-input"
                                            aria-describedby="academic_program_idHelp"
                                            value={{ $academicProgram->id }}


                                        />
                                        <label class="form-check-label" for={{ $academicProgram->name }}>
                                            {{ $academicProgram->name }}
                                        </label>
                                    </div>
                                @empty

                                    <div>No hay programas de formación en esta instución</div>

                                @endforelse

                                {{-- <span class={rules.academic_program_id.isInvalid && rules.academic_program_id.message !== '' || requestValidation.academic_program_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                    {rules.academic_program_id.message ? rules.academic_program_id.message : requestValidation.academic_program_id ? requestValidation.academic_program_id : '' }
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="">Grupo de investigación</label>
                                <small id="research_group_idHelp" class="form-text text-muted">Campo requerido</small>
                                <select
                                    name="research_group_id"
                                    id="research_group_id"
                                    class="form-control"
                                    aria-describedby="research_group_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione un grupo de investigación</option>

                                    @forelse ($researchGroups as $researchGroup)
                                        <option value={{ $researchGroup->id }} >{{ $researchGroup->name }}</option>
                                    @empty
                                        <option value=''>No research groups by this institution</option>
                                    @endforelse

                                </select>
                                <span class="invalid-feedback">
                                    {{-- {rules.research_group_id.message ? rules.research_group_id.message : requestValidation.research_group_id ? requestValidation.research_group_id : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Líneas de investigación</label>
                                <small id="research_line_idHelp" class="form-text text-muted">Campo requerido</small>

                                @forelse ($researchLines as $researchLine)
                                    <div class="form-check ml-2">
                                        <input
                                            type="checkbox"
                                            name="research_line_id[]"
                                            id={{ $researchLine->name }}
                                            class="form-check-input"
                                            aria-describedby="research_line_idHelp"
                                            value={{ $researchLine->id }}
                                        />
                                        <label class="form-check-label" for={{ $researchLine->name }}>
                                            {{ $researchLine->name }}
                                        </label>
                                    </div>
                                @empty
                                    <div>No research lines</div>
                                @endforelse

                                {{-- <span class={rules.research_line_id.isInvalid && rules.research_line_id.message !== '' || requestValidation.research_line_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                                    {rules.research_line_id.message ? rules.research_line_id.message : requestValidation.research_line_id ? requestValidation.research_line_id : '' }
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="administrator_id">Administrador del semillero</label>
                                <small id="administrator_idHelp" class="form-text text-muted">Campo requerido</small>
                                <select
                                    name="administrator_id"
                                    id="administrator_id"
                                    class="form-control"
                                    aria-describedby="administrator_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione un administrador de semillero</option>

                                    {{-- @forelse ($researchTeamAdmin as $ResearchTeamAdmin)
                                        <option value={{ $ResearchTeamAdmin->id }} >{{ $ResearchTeamAdmin->user->name }}</option>
                                    @empty
                                        <option value=''>No research groups by this institution</option>
                                    @endforelse  --}}

                                </select>
                                {{-- <span class="invalid-feedback">
                                    {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''}
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="thematic_research">Temáticas de investigación (Separados por coma)</label>
                                <small id="thematic_researchHelp" class="form-text text-muted">Campo requerido</small>
                                <textarea
                                    name="thematic_research"
                                    id="misthematic_researchsion"
                                    class="form-control"
                                    aria-describedby="thematic_researchHelp"
                                    required
                                ></textarea>
                                <span class="invalid-feedback">
                                    {{-- {rules.thematic_research.message ? rules.thematic_research.message : requestValidation.thematic_research ? requestValidation.thematic_research : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <button type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>


</x-app-layout>
