<x-guest-layout>

    <x-guest-header :node="$node" image="">
        <x-slot name="title">
            <h1 class="text-3xl text-center sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    {{ $user->name }}
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            {{ $memberEducationalInstitution->name ?? '' }}
            <img class="h-40 w-40 rounded-full mx-auto" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
        </x-slot>
        <x-slot name="actionButton">
            
        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="p-8 mt-4">

                <h1 class="text-2xl">{{ __('Biography') }}</h1>
                <p class="mt-4 whitespace-pre-line">{{ $user->biography }}</p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Email') }}</h1>
                <a href="mailto:{{ $user->email }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ $user->email }} - Enviar correo electrónico
                </a>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('CvLac') }}</h1>
                @if ($user->cvlac)
                    <a href="{{ $user->cvlac }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-4 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Ir al CvLac
                    </a>
                @else
                    <p>{{ __('No data recorded') }}</p>
                @endif

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Interests') }}</h1>
                <p class="mt-4 text-gray-400 capitalize">
                    @foreach (explode(',', implode(json_decode($user->interests))) as $interest)
                        {{ $interest }}
                    @endforeach
                </p>

                <x-jet-section-border />

                @if (Storage::disk('public')->exists($user->file))
                    <h1 class="text-2xl">{{ __('File') }}</h1>
                    <a href="{{ url("storage/$user->file") }}" class="mt-4 underline" target="_blank" download>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Descargar hoja de vida
                    </a>
                    <x-jet-section-border />
                @endif
        
                <h1 class="text-2xl mt-12 ml-16">{{ __('Graduations') }}</h1>
                @forelse ($user->userGraduations->chunk(3) as $chunk)
                    <div class="mt-4 md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $graduation)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        <h2 class=" text-xl title-font font-medium mb-3">
                                            {{ $graduation->academicProgram->academic_level }} en {{ $graduation->academicProgram->name }}
                                        </h2>
                                    </div>
                                </div>
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ $graduation->academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                    <p class="leading-relaxed text-sm text-justify">
                                        <small>{{ $graduation->is_graduated ? "Año de grado $graduation->year" : 'Estudiante' }}</small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="mt-12 ml-16">{{ __('No data recorded') }}</p>
                @endforelse

                <x-jet-section-border />

                <h1 class="text-2xl mt-12 ml-16">{{ __('Research teams') }}</h1>
                @forelse ($user->researchTeams->chunk(3) as $chunk)
                    <div class="mt-4 md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $researchTeam)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        <h2 class=" text-xl title-font font-medium mb-3">
                                            {{ $researchTeam->name }}
                                        </h2>
                                        <p class="leading-relaxed text-sm text-justify">
                                            <small></small>
                                        </p>
                                    </div>
                                </div>
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                    <p class="text-gray-400"><small>Grupo de investigación: {{ $researchTeam->researchGroup->educationalInstitutionFaculty->name }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="mt-12 ml-16">{{ __('No data recorded') }}</p>
                @endforelse

                <x-jet-section-border />

                <h1 class="text-2xl mt-12 ml-16">{{ __('Projects') }}</h1>
                @forelse ($user->projects->chunk(3) as $chunk)
                    <div class="mt-4 md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $project)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        <h2 class=" text-xl title-font font-medium mb-3">
                                            <a href="{{ route('nodes.explorer.searchProjects.showProject', [$node, $project]) }}" target="_blank">
                                                {{ $project->title }}
                                            </a>
                                        </h2>
                                        <p class="leading-relaxed text-sm text-justify">
                                            <small></small>
                                        </p>
                                    </div>
                                </div>
                                @php
                                  $researchTeam = $project->researchTeams()->where('is_principal', 1)->first();
                                @endphp
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ $researchTeam->researchGroup->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                    <p class="text-gray-400"><small>Grupo de investigación: {{ $researchTeam->researchGroup->educationalInstitutionFaculty->name }}</small></p>
                                    <p class="text-gray-400"><small>Semillero de investigación: {{ $researchTeam->name }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="mt-12 ml-16">{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="relative bg-cool-gray-200 overflow-hidden" id="role-requirements">
        <div class="mx-auto">
            <div class="relative pl-4 z-10 lg:max-w-2xl flex items-center h-64 lg:w-full">
                <div>
                    <h1 class="inline-flex text-4xl tracking-tight font-extrabold leading-none mt-2">
                        <span class="block xl:inline">Invite a este joven investigador para que participe en uno de sus proyectos</span>
                    </h1>
                    <p class="mt-4 mb-4">A continuación se listan los proyectos</p>
                    <form method="POST" action="{{ route('nodes.explorer.sendRoleNotification', [$node, $user]) }}">
                        @csrf
    
                        <div>
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
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ url("storage/images/AdobeStock_Hiring.jpeg") }}">
        </div>
    </div>

    <x-footer />

</x-guest-layout>