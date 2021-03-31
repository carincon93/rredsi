<title>{{ "#EventosRREDSI".$node->state.date('Y')." - ".config('app.name') }}</title>

<x-guest-layout>
    <x-guest-header :node="$node" image="images/node-info.jpg">
        <x-slot name="title">
            <h1 class="text-5xl sm:text-4xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="h-7 inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg>
                    #EventosRREDSI{{$node->state}}{{ date('Y') }}
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
                    <x-slot name="description"></x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('annualNodeEvent.registerAnnualNodeEvents', [$node, $annualNodeEvent]) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-1/12">
                        <x-jet-label class="mb-4" for="presentation_type" value="{{ __('Presentation type') }}" />
                        <select id="presentation_type" name="presentation_type" class="form-select w-full" required >
                            <option value="">Seleccione el tipo de presentación</option>
                            <option {{ old('presentation_type') == "Ponencia oral" ? "selected" : ""  }} value="Ponencia oral">Ponencia oral</option>
                            <option {{ old('presentation_type') == "Póster (Propuestas de investigación)" ? "selected" : ""  }} value="Póster (Propuestas de investigación)">Póster (Propuestas de investigación)</option>
                        </select>
                        <x-jet-input-error for="presentation_type" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <x-jet-label class="mb-4" for="project_status" value="{{ __('Project type') }}" />
                        <select id="project_status" name="project_status" class="form-select w-full" required >
                            <option value="">Seleccione el tipo de proyecto</option>
                            <option {{ old('project_status') == "Proyecto en curso" ? "selected" : ""  }} value="Proyecto en curso">Proyecto en curso</option>
                            <option {{ old('project_status') == "Proyecto terminado" ? "selected" : ""  }} value="Proyecto terminado">Proyecto terminado</option>
                            <option {{ old('project_status') == "Propuesta proyecto de investigación (Aplica solo para póster)" ? "selected" : ""  }} value="Propuesta proyecto de investigación (Aplica solo para póster)">Propuesta proyecto de investigación (Aplica solo para póster)</option>
                        </select>
                        <x-jet-input-error for="project_status" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <x-jet-label class="mb-4" for="project_id" value="{{ __('Projects') }}" />
                        <select id="project_id" name="project_id" class="form-select w-full" required  onchange="SwitchProject.onChange(event)">
                            <option value="">Seleccione el proyecto</option>
                            @forelse ($projects as $project)
                                <option {{ old('project_id') == $project->id ? "selected" : ""  }} value="{{ $project->id }}">{{ $project->title }}</option>
                            @empty
                                <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No data recorded') }}</p>
                            @endforelse
                        </select>
                        <x-jet-input-error for="project_id" class="mt-2" />
                    </div>

                    <div class="mt-1/12"">
                        <p>{{ __('Speakers') }}</p>
                        <div class="ml-4">
                            <div class="flex">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 first_speaker_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{-- <x-jet-label class="mb-4" for="first_speaker_id" value="{{ __('first speaker') }}" /> --}}
                            </div>
                            <select onchange="SwitchProject.SpeakersTwo(event)" id="first_speaker_id" name="first_speaker_id" class="overflow-hidden bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" required disabled>
                                <option value="">Para seleccionar un ponente debe seleccionar el proyecto</option>
                            </select>
                            <x-jet-input-error for="first_speaker_id" class="mt-2" />
                        </div>

                        <div class="ml-4">
                            <div class="flex">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-400 second_speaker_id_spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{-- <x-jet-label class="mb-4" for="second_speaker_id" value="{{ __('second speaker') }}" /> --}}
                            </div>
                            <select class="overflow-hidden bg-transparent focus:outline-none form-select rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" disabled id="second_speaker_id" name="second_speaker_id">
                                <option value="">Seleccione el segundo ponente</option>
                            </select>
                            <x-jet-input-error for="second_speaker_id" class="mt-2" />
                        </div>
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
                        <x-jet-label class="mb-4" for="academic_program_id" value="{{ __('Academic programs') }}" />
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
                        <x-jet-label class="mb-4" for="research_team_id" value="{{ __('Research teams') }}" />
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
                        <x-jet-label class="mb-4" for="endorsement_letter" value="{{ __('Endorsement letter') }}" />
                        <x-jet-input id="endorsement_letter" class="block mt-1 w-full" type="file" accept="application/pdf" name="endorsement_letter" value="{{ old('endorsement_letter') }}" />
                        <x-jet-input-error for="endorsement_letter" class="mt-2" />
                    </div>

                    <div class="mt-1/12">
                        <p>
                            Adjunte en este espacio el documento completo para la elaboración de las memorias (Ver punto 6 de la guía de Inscripción, El archivo debe ser PDF y su tamaño de debe sobrepasar los 500kb)
                        </p>
                        <x-jet-label class="mb-4" for="project_article" value="{{ __('Research doc') }}" />
                        <x-jet-input id="project_article" class="block mt-1 w-full" type="file" accept="application/pdf" name="project_article" value="{{ old('project_article') }}" />
                        <x-jet-input-error for="project_article" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button onclick="resetStorage()" class="ml-4">
                            {{ __('Register event') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @once
    @push('scripts')
        <script>
            document.addEventListener(
                "DOMContentLoaded",
                    function() {
                        window.firstSpeakerSpin       = document.querySelector('.first_speaker_id_spin');
                        window.secondSpeakerSpin      = document.querySelector('.second_speaker_id_spin');

                        if(sessionStorage.getItem('project_id')){
                            var project_id            = sessionStorage.getItem('project_id');
                            SwitchProject.oldValues(project_id);
                        }

                        // LIMPIAR local storage si status de validiacion existe
                        var sessionStatus="<?php echo session('status');?>";
                        if(sessionStatus){
                            sessionStorage.clear();
                        }

            }, false)

            var SwitchProject = (function() {
                let project_id = null;

                getAllAuthors = async (project_id) => {
                    sessionStorage.setItem('project_id', project_id);

                    var first_speaker_id    = document.getElementById("first_speaker_id");
                    first_speaker_id.innerHTML = '<option value="">Seleccione el primer ponente</option>';

                    if (project_id != 0) {
                        firstSpeakerSpin.classList.remove('hidden');
                        firstSpeakerSpin.classList.add('inline');
                        try {
                            const uri       = `/api/projects/${project_id}/authors/`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.authors.map(function(author) {
                                first_speaker_id.removeAttribute('disabled');
                                let option = `<option value="${author.id}">${author.name}</option>`;
                                first_speaker_id.innerHTML += option;
                            })

                            if (result.authors.length > 0) {
                                firstSpeakerSpin.classList.remove('inline');
                                firstSpeakerSpin.classList.add('hidden');
                            }

                            if(sessionStorage.getItem('SpeakerOne')){
                                let SpeakerOne = sessionStorage.getItem('SpeakerOne');
                                first_speaker_id.querySelector(`option[value="${SpeakerOne}"]`).setAttribute('selected', 'selected');
                                getAllAuthorsTwo(project_id,SpeakerOne);
                            }

                        } catch (error) {
                            console.log(error);
                        }
                    }
                }

                getAllAuthorsTwo = async (project_id,SpeakerOne) => {
                    sessionStorage.setItem('SpeakerOne', SpeakerOne);
                    var second_speaker_id   = document.getElementById("second_speaker_id");
                    second_speaker_id.innerHTML = '<option value="">Seleccione el segundo ponente</option>';

                    if (project_id != 0) {
                        secondSpeakerSpin.classList.remove('hidden');
                        secondSpeakerSpin.classList.add('inline');
                        try {
                            const uri       = `/api/projects/${project_id}/authors/`;
                            const response  = await fetch(uri);
                            const result    = await response.json();

                            result.authors.map(function(author) {
                                second_speaker_id.removeAttribute('disabled');
                                if(SpeakerOne != author.id ){
                                    let option = `<option value="${author.id}">${author.name}</option>`;
                                    second_speaker_id.innerHTML += option;
                                }

                            })

                            if (result.authors.length > 0) {
                                secondSpeakerSpin.classList.remove('inline');
                                secondSpeakerSpin.classList.add('hidden');
                            }

                            if(sessionStorage.getItem('SpeakerTwo')){
                                let SpeakerTwo = sessionStorage.getItem('SpeakerTwo');
                                second_speaker_id.querySelector(`option[value="${SpeakerTwo}"]`).setAttribute('selected', 'selected');
                            }

                        } catch (error) {
                            console.log(error);
                        }
                    }
                }


                return {
                    oldValues: function(e) {
                        project_id = e;
                        getAllAuthors(project_id);
                    },
                    onChange: function(e) {
                        project_id = e.target.value;
                        getAllAuthors(project_id);
                    },
                    SpeakersTwo: function(e) {
                        var project_id    = document.getElementById('project_id').value;
                        SpeakerOne = e.target.value;
                        getAllAuthorsTwo(project_id,SpeakerOne);
                    },
                }
            })();

            function resetStorage() {

                if(!sessionStorage.getItem('clickCount')){
                    sessionStorage.setItem('clickCount', 0);
                }

                var SpeakerTwo    = document.getElementById('second_speaker_id').value;

                if(SpeakerTwo > 0){
                    sessionStorage.setItem('SpeakerTwo', SpeakerTwo);
                }

                if(sessionStorage.getItem('clickCount') == 1){
                    sessionStorage.clear();
                }

                if(sessionStorage.getItem('clickCount') == 0){
                    sessionStorage.setItem('clickCount', 1);
                }

            }


        </script>
    @endpush
@endonce


  {{--Alert component --}}
  @if (session('status'))
    <x-data-alert />
@endif

</x-guest-layout>
