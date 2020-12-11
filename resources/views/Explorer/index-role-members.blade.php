<x-guest-layout>

    <x-guest-header :node="$node" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4" style="background: url(/storage/images/explorer.png)">
                <div class="mt-8 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-4 h-64" style="background: url(/storage/images/networking.jpg)">
                    <div class="p-6">
                        <div class="flex items-center mt-4">
                            <div>
                                <h1 class="text-center text-2xl leading-none text-black mt-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="h-7 inline mb-2">
                                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#000" />
                                    </svg>
                                    Explorer: Conecte con estudiantes o profesionales del programa {{ $academicProgram->name }} de la institución educativa {{ $academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}.
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 mt-4">
                @forelse ($node->roleMembers as $roleMember)

                    <x-jet-section-border />

                    <div>
                        <div class="p-4">
                            <p class="text-2xl mb-4">{{ $roleMember->name }}</p>
                            <p class="text-gray-400 capitalize text-justify">
                                {{ __('Biography') }}:
                                <br>
                                <small>
                                    {{ substr($roleMember->biography, 0, 550) }}...
                                </small>
                            </p>
                            <p class="text-gray-400 capitalize mt-2">
                                {{ __('Interests') }}:
                                <br>
                                <small>
                                    @foreach (json_decode($roleMember->interests) as $interests) 
                                        {{ substr($interests, 0, -1) }}
                                    @endforeach
                                </small>
                            </p>
                            <p class="text-gray-400 mt-2">
                                {{ __('CvLac') }}:
                                <br>
                                <small>
                                    <a href="{{ $roleMember->cvlac }}" target="_blank" class="underline">
                                        Ver CvLac 
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-4 text-gray-200">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </small>
                            </p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 text-gray-200 mt-4">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                            <p class="mb-4 w-full">Información académica</p>
                            @forelse ($roleMember->userGraduations->take(2) as $userGraduation)
                                <p class="text-gray-400 mt-4">
                                    {{ $userGraduation->is_graduated ? 'Profesional del programa ' : 'Estudiante del programa' }} {{ $userGraduation->academicProgram->name }}
                                    <br>
                                    <small>{{ $userGraduation->academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}</small>
                                </p>
                            @empty
                                <p class="mt-4"><small>{{ __('No data recorded') }}</small></p>
                            @endforelse
                            <form method="POST" action="{{ route('nodes.explorer.sendRoleNotification', [$node, $roleMember]) }}">
                                @csrf
            
                                <div class="mt-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-7 mb-4 text-black mt-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    <x-jet-label for="project_id" value="Enviar invitación de participación en el proyecto" class="mb-4 w-full" />
                                    <select id="project_id" name="project_id" class="form-select w-full" required >
                                        <option value="">Seleccione un proyecto</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? "selected" : "" }}>{{ $project->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="project_id" class="mt-2" />
                                </div>
            
                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button class="ml-4">
                                        {{ __('Contact') }}
            
                                        <div class="ml-1 text-white">
                                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    </x-jet-button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>