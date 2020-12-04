<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Projects') }}
            <span class="sm:block text-purple-300">
                Update project info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar la información del proyecto de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">

                <form method="POST" action="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.update', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mt-4">
                        <x-jet-label for="project_type_id" value="{{ __('Project type') }}" />
                        <select id="project_type_id" name="project_type_id" class="form-select w-full" required >
                            <option value="">Seleccione un tipo de proyecto</option>
                            @forelse ($projectTypes as $projectType)
                                <option value="{{ $projectType->id }}" {{ old('project_type_id') == $projectType->id || $project->projectType->id == $projectType->id ? "selected" : "" }}>{{ $projectType->type }}</option>
                            @empty
                                <option value="">No project types data</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_type_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <textarea id="title" name="title" max="255" class="block mt-1 p-4 w-full" required >{{ old('title') ?? $project->title }}</textarea>
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="start_date" value="{{ __('Start date') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="start_date" value="{{ old('start_date') ?? $project->start_date }}" required />
                        <x-jet-input-error for="start_date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="end_date" value="{{ __('End date') }}" />
                        <x-jet-input id="end_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="end_date" value="{{ old('end_date') ?? $project->end_date }}" required />
                        <x-jet-input-error for="end_date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="abstract" value="{{ __('Abstract') }}" />
                        <textarea id="abstract" name="abstract" class="block mt-1 p-4 w-full" required >{{ old('abstract') ?? $project->abstract }}</textarea>
                        <x-jet-input-error for="abstract" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="overall_objective" value="{{ __('Overall objective') }}" />
                        <textarea id="overall_objective" name="overall_objective" class="block mt-1 p-4 w-full" required >{{ old('overall_objective') ?? $project->overall_objective }}</textarea>
                        <x-jet-input-error for="overall_objective" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="keywords" value="{{ __('Keywords') }}" />
                        <textarea id="keywords" name="keywords" class="block mt-1 p-4 w-full" required >{{ old('keywords') ?? $project->keywords }}</textarea>
                        <x-jet-input-error for="keywords" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="file" value="{{ __('File') }}" />
                        <x-jet-input id="file" class="block mt-1 w-full" type="file" name="file" value="{{ old('file') }}" />
                        <x-jet-input-error for="file" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is privated?') }} </p>
                    <div class="block mt-4">
                        <label for="is_privated_yes" class="flex items-center">
                            <input id="is_privated_yes" value="1" type="radio" class="form-radio" name="is_privated" {{ old('is_privated') == 1 || $project->is_privated == 1 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_privated_no" class="flex items-center">
                            <input id="is_privated_no" value="0" type="radio" class="form-radio" name="is_privated" {{ old('is_privated') != null && old('is_privated') == 0 || $project->is_privated != null && $project->is_privated == 0 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_privated" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is published?') }} </p>
                    <div class="block mt-4">
                        <label for="is_published_yes" class="flex items-center">
                            <input id="is_published_yes" value="1" type="radio" class="form-radio" name="is_published" {{ old('is_published') == 1 || $project->is_published == 1 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_published_no" class="flex items-center">
                            <input id="is_published_no" value="0" type="radio" class="form-radio" name="is_published" {{ old('is_published') != null && old('is_published') == 0 || $project->is_published != null && $project->is_published == 0 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_published" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <p>{{ __('Authors' ) }} </p>
                        @forelse ($authors as $author)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="user_id[]" @if(is_array(old('user_id')) && in_array($author->id, old('user_id'))) checked @elseif($project->authors->pluck('id')->contains($author->id)) checked  @endif id="{{ "author-$author->id" }}" value="{{ $author->id }}" />
                                <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "author-$author->id" }}">{{ $author->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded' ) }}</p>
                        @endforelse
                        <x-jet-input-error for="user_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <p>{{ __('Academic programs' ) }} </p>
                        @forelse ($academicPrograms as $academicProgram)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="academic_program_id[]" @if(is_array(old('academic_program_id')) && in_array($academicProgram->id, old('academic_program_id'))) checked @elseif($project->academicPrograms->pluck('id')->contains($academicProgram->id)) checked  @endif id="{{ "academic-program-$academicProgram->id" }}" value="{{ $academicProgram->id }}" />
                                <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "academic-program-$academicProgram->id" }}">{{ $academicProgram->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded' ) }}</p>
                        @endforelse
                        <x-jet-input-error for="academic_program_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <p>{{ __('Knowledge subareas disciplines' ) }} </p>
                        @forelse ($knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="knowledge_subarea_dicipline_id[]" @if(is_array(old('knowledge_subarea_dicipline_id')) && in_array($knowledgeSubareaDiscipline->id , old('knowledge_subarea_dicipline_id'))) checked @elseif($project->knowledgeSubareaDisciplines->pluck('id')->contains($knowledgeSubareaDiscipline->id)) checked  @endif  id="{{ "knowledge-subarea-dicipline-$knowledgeSubareaDiscipline->id" }}" value="{{ $knowledgeSubareaDiscipline->id }}" />
                                <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "knowledge-subarea-dicipline-$knowledgeSubareaDiscipline->id" }}">{{ $knowledgeSubareaDiscipline->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded' ) }}</p>
                        @endforelse
                        <x-jet-input-error for="knowledge_subarea_dicipline_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <p>{{ __('Research teams' ) }} </p>
                        @forelse ($researchTeams as $researchTeam)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="research_team_id[]" @if(is_array(old('research_team_id')) && in_array($researchTeam->id, old('research_team_id'))) checked @elseif($project->researchTeams->pluck('id')->contains($researchTeam->id)) checked  @endif id="{{ "research-team-$researchTeam->id" }}" value="{{ $researchTeam->id }}" />
                                <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "research-team-$researchTeam->id" }}">{{ $researchTeam->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded' ) }}</p>
                        @endforelse
                        <x-jet-input-error for="research_team_id" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <p>{{ __('Research lines' ) }} </p>
                        @forelse ($researchLines as $researchLine)
                            <div class="mt-4">
                                <input class="form-check-input" type="checkbox" name="research_line_id[]" @if(is_array(old('user_id')) && in_array($author->id, old('user_id'))) checked @elseif($project->researchLines->pluck('id')->contains($researchLine->id)) checked  @endif id="{{ "research-line-$researchLine->id" }}" value="{{ $researchLine->id }}" />
                                <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ "research-line-$researchLine->id" }}">{{ $researchLine->name }}</label>
                            </div>
                        @empty
                            <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded' ) }}</p>
                        @endforelse
                        <x-jet-input-error for="research_line_id" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Edit') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
