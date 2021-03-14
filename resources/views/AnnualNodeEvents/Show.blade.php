<title>{{ "Detalles del proyecto $project->title"}}</title>
<x-app-layout>
    @push('styles')
    <style>
        .modal {
          transition: opacity 0.25s ease;
        }
        body.modal-active {
          overflow: hidden;
        }
    </style>
    @endpush
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Show project and annual node event') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    Proyecto de evento de RREDSI
                </span>
            </h2>
        </div>
        {{-- <a href="{{ route('nodes.educational-institutions.faculties.users.edit', [$node, $educationalInstitution, $faculty, $user]) }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Edit educational institution user') }}
            </div>
        </a> --}}
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del proyecto al evento anual</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Educational institution') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ optional($project->researchTeams())->where('is_principal',1)->first()->researchGroup->educationalInstitutionFaculty->educationalInstitution->name }}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Academic program') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->academicPrograms as $academicProgram)
                            <p>
                                {{ $academicProgram->name }}
                            </p>
                         @endforeach
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Research team') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchTeams as $researchTeam)
                            <p>
                                {{ $researchTeam->name }}
                            </p>
                        @endforeach
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Research line') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchLines as $researchLine)
                            <p>
                                {{ $researchLine->name }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block">
            <div class="py-8">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del tutor de semillero</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchTeams as $researchTeam)
                            <p>
                                {{ $researchTeam->mentor_name }}
                            </p>
                        @endforeach
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Email') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchTeams as $researchTeam)
                            <p>
                                {{ $researchTeam->mentor_email }}
                            </p>
                        @endforeach
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Cellphone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchTeams as $researchTeam)
                            <p>
                                {{ $researchTeam->mentor_cellphone }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block">
            <div class="py-8">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del proyecto</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Title') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $project->title}}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Authors') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->authors as $author)
                            <p>
                                {{ $author->name}}
                            </p>
                        @endforeach
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Cellphone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @foreach ($project->researchTeams as $researchTeam)
                        <p>
                            {{ $researchTeam->mentor_cellphone }}
                        </p>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden sm:block">
            <div class="py-8">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del ponente #1</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                          {{$first_speaker->name}}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Document number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p class="uppercase ">
                            {{ $first_speaker->document_type }}   {{ $first_speaker->document_number }}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Email') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $first_speaker->email }}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Cellphone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $first_speaker->cellphone_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del ponente #2</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                          {{$second_speaker->name}}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Document number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p class="uppercase ">
                            {{ $second_speaker->document_type }}   {{ $second_speaker->document_number }}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Email') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $second_speaker->email }}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Cellphone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $second_speaker->cellphone_number }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información de presentacion de projecto</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Presentation type') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                          {{$annualNodeEvent->presentation_type}}
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
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{__('Knowledge area')}}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        @if ($project->knowledgeSubareaDisciplines()->first())
                            <p>
                                {{ optional($project->knowledgeSubareaDisciplines())->first()->knowledgeSubarea()->first()->knowledgeArea->name }}
                            </p>
                        @else
                            <p>
                                {{ __('No data recorded') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="py-8">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>
    </div>
    @if (is_null($annualNodeEvent->status))
        {{-- Enviar notificacion aceptacion --}}
        <form method="POST" action="{{ route('annualNodeEvent.update',[$annualNodeEvent]) }}">
            @csrf()
            @method('PUT')

            <input hidden id="status" name="status" value="1">
            <input hidden id="project_id" name="project_id" value="{{$project->id}}">

            <div class="flex items-center justify-center mt-2">
                <x-jet-button type="submit">
                    {{ __('Aceptar') }}
                </x-jet-button>

                <x-jet-button class="modal-open ml-4">
                    {{ __('Denegar') }}
                </x-jet-button>
            </div>
        </form>
    @endif

    {{-- Enviar notificacion de rechazo modal de comentarios --}}
    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <div>
                        <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="inline font-bold text-gray-700 text-lg ml-0 pl-0">Information</span>
                    </div>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="h-5 w-6 text-red-500"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <form method="POST" action="{{ route('annualNodeEvent.update',[$annualNodeEvent]) }}">
                    @csrf()
                    @method('PUT')

                    <!--Body-->
                    <div class="px-5 py-2 text-gray-600">
                        <label for="datos">Escriba los motivos de rechazo de la solicitud.</label>
                        <textarea required class="form-control border border-gray-300" rows="2" cols="40" id="comments" name="comments"></textarea>
                    </div>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <input hidden  name="status" value="0">
                        <input hidden  name="project_id" value="{{$project->id}}">

                        <button type="submit" class="px-4 bg-transparent p-3 rounded-lg text-white bg-blue-900 hover:bg-blue-800 mr-2">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var openmodal = document.querySelectorAll('.modal-open')
            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function(event){
                event.preventDefault()
                toggleModal()
                })
            }

            const overlay = document.querySelector('.modal-overlay')
            overlay.addEventListener('click', toggleModal)

            var closemodal = document.querySelectorAll('.modal-close')
            for (var i = 0; i < closemodal.length; i++) {
                closemodal[i].addEventListener('click', toggleModal)
            }

            document.onkeydown = function(evt) {
                evt = evt || window.event
                var isEscape = false
                if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
                } else {
                isEscape = (evt.keyCode === 27)
                }
                if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
                }
            };


            function toggleModal () {
                const body = document.querySelector('body')
                const modal = document.querySelector('.modal')
                modal.classList.toggle('opacity-0')
                modal.classList.toggle('pointer-events-none')
                body.classList.toggle('modal-active')
            }
        </script>
    @endpush
</x-app-layout>
