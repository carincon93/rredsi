<title>{{'Crear semillero de investigación'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Research teams') }}
                <span class="text-base sm:text-lg block text-purple-300">
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.index', [$node, $educationalInstitution, $faculty, $researchGroup]) }}" class="text-white font-weight underline">Lista de semilleros de investigación</a> / Crear semillero de investigación
                </span>
            </h2>
        </div>
        {{-- @can('index_research_team')
        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.index', [$node, $educationalInstitution, $faculty, $researchGroup]) }}">
            <div class="w-auto text-center text-sm sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
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
                    <x-slot name="description">Crear semillero de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.store', [$node, $educationalInstitution, $faculty, $researchGroup]) }}">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text"  max="191" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="mentor_name" value="{{ __('Mentor name') }}" />
                        <x-jet-input id="mentor_name" class="block mt-1 w-full" type="text" max="191" name="mentor_name" value="{{ old('mentor_name') }}" required />
                        <x-jet-input-error for="mentor_name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="mentor_email" value="{{ __('Mentor email') }}" />
                        <x-jet-input id="mentor_email" class="block mt-1 w-full" type="email" max="191" name="mentor_email" value="{{ old('mentor_email') }}" required />
                        <x-jet-input-error for="mentor_email" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="mentor_cellphone" value="{{ __('Mentor cellphone') }}" />
                        <x-jet-input id="mentor_cellphone" class="block mt-1 w-full" type="number" min="0" maxlength="9999999999" name="mentor_cellphone" value="{{ old('mentor_cellphone') }}" required />
                        <x-jet-input-error for="mentor_cellphone" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="overall_objective" value="{{ __('Overall objective') }}" />
                        <textarea rows="20" id="overall_objective" name="overall_objective" class="form-textarea border-0 w-full" required >{{ old('overall_objective') }}</textarea>
                        <x-jet-input-error for="overall_objective" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="mission" value="{{ __('Mission') }}" />
                        <textarea rows="20" id="mission" name="mission" class="form-textarea border-0 w-full" required >{{ old('mission') }}</textarea>
                        <x-jet-input-error for="mission" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="vision" value="{{ __('Vision') }}" />
                        <textarea rows="20" id="vision" name="vision" class="form-textarea border-0 w-full" required >{{ old('vision') }}</textarea>
                        <x-jet-input-error for="vision" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="regional_projection" value="{{ __('Regional projection') }}" />
                        <textarea rows="20" id="regional_projection" name="regional_projection" class="form-textarea border-0 w-full" required >{{ old('regional_projection') }}</textarea>
                        <x-jet-input-error for="regional_projection" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="knowledge_production_strategy" value="{{ __('Knowledge production strategy') }}" />
                        <textarea rows="20" id="knowledge_production_strategy" name="knowledge_production_strategy" class="form-textarea border-0 w-full" required >{{ old('knowledge_production_strategy') }}</textarea>
                        <x-jet-input-error for="knowledge_production_strategy" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="creation_date" value="{{ __('Creation date') }}" />
                        <x-jet-input id="creation_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="creation_date" value="{{ old('creation_date') }}" required />
                        <x-jet-input-error for="creation_date" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="thematic_research" value="{{ __('Thematic research') }}" />
                        <small class="inline-block text-gray-500">Separe con comas cada temática de investigación</small>
                        <textarea rows="20" id="thematic_research" name="thematic_research" class="form-textarea border-0 w-full" required >{{ old('thematic_research') }}</textarea>
                        <x-jet-input-error for="thematic_research" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Research lines') }} asociados</p>
                    <div class="block mt-4">
                        @forelse ($researchLines as $researchLine)
                            <label for="{{ "research-line-$researchLine->id" }}" class="flex items-center">
                                <input @if(is_array(old('research_line_id')) && in_array($researchLine->id, old('research_line_id'))) checked @endif id="{{ "research-line-$researchLine->id" }}" value="{{ $researchLine->id }}" type="checkbox" class="form-checkbox" name="research_line_id[]">
                                <span class="ml-2 text-sm text-gray-600">{{ $researchLine->name }}</span>
                            </label>
                        @empty
                            <p>{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="research_line_id" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Academic programs') }} asociados</p>
                    <div class="block mt-4">
                        @forelse ($academicPrograms as $academicProgram)
                            <label for="{{ "academic-program-$academicProgram->id" }}" class="flex items-center">
                                <input @if(is_array(old('academic_program_id')) && in_array($academicProgram->id , old('academic_program_id'))) checked @endif id="{{ "academic-program-$academicProgram->id" }}" value="{{ $academicProgram->id }}" type="checkbox" class="form-checkbox" name="academic_program_id[]">
                                <span class="ml-2 text-sm text-gray-600">{{ $academicProgram->name }}</span>
                            </label>
                        @empty
                            <p>{{ __('No data recorded') }}</p>
                        @endforelse
                        <x-jet-input-error for="academic_program_id" class="mt-2" />
                    </div>

                    <hr class="mt-1/6 mb-1/6">

                    <p>A continuación, debe seleccionar una o varias disciplinas de subáreas de conocimiento. Diríjase a la área de conocimiento y luego de clic en una subárea de conocimiento para que se listen las disciplinas.</p>

                    <x-checkbox-knowledge-subarea-discipline :knowledgeAreas="$knowledgeAreas" :model="null" />

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
