<title>{{ "Editar información de $userAcademicWork->title"}}</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Academic works') }}
            <span class="sm:block text-purple-300">
                Update academic work info
            </span>
        </h2>
        <div>
            @can('index_academic_work')
            <a href="{{ route('user.profile.user-graduations.user-academic-works.index', [$userGraduation]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back')}}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar la información del trabajo académica</x-slot>
                </x-jet-section-title>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('user.profile.user-graduations.user-academic-works.update', [$userGraduation, $userAcademicWork] ) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" min="" max="" name="title" value="{{ $userAcademicWork->title }}" required />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="type" value="{{ __('Type') }}" />
                        <select id="type" name="type" class="form-select w-full" required >
                            <option value="">Seleccione un tipo de trabajo académico</option>
                            <option {{ old('type') == "tesis de doctorado" || $userAcademicWork->type == "tesis de doctorado" ? "selected" : ""}} value="tesis de doctorado">Tesis de doctorado</option>
                            <option {{ old('type') == "tesis de maestría" || $userAcademicWork->type == "tesis de maestría" ? "selected" : ""}} value="tesis de maestría">Tesis de maestría</option>
                            <option {{ old('type') == "trabajo de grado" || $userAcademicWork->type == "trabajo de grado" ? "selected" : ""}} value="trabajo de grado">Trabajo de grado</option>
                            <option {{ old('type') == "trabajos de i+d+I con formación" || $userAcademicWork->type == "trabajos de i+d+I con formación" ? "selected" : ""}} value="trabajos de i+d+I con formación">Trabajos de i+d+I con formación</option>
                            <option {{ old('type') == "apoyo de programas de formación" || $userAcademicWork->type == "apoyo de programas de formación" ? "selected" : ""}} value="apoyo de programas de formación">Apoyo de programas de formación</option>
                        </select>
                        <x-jet-input-error for="type" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="authors" value="{{ __('Authors') }}" />
                        <textarea id="authors" name="authors" class="form-textarea border-0 w-full" required >{{ old('authors') ?? $userAcademicWork->mentors}}</textarea>
                        <x-jet-input-error for="authors" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="grade" value="{{ __('Grade') }}" />
                        <select id="grade" name="grade" class="form-select w-full" required >
                            <option value="">Seleccione una nota</option>
                            @for ($i = 0; $i < 5; $i+=0.1)
                                <option value="{{ $i }}" {{ old('grade') == "$i" || $userAcademicWork->grade == "$i" ? "selected" : "" }}>{{ $i }}</option>
                            @endfor
                        </select>
                        <x-jet-input-error for="grade" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="mentors" value="{{ __('Mentors') }}" />
                        <textarea id="mentors" name="mentors" class="form-textarea border-0 w-full" required >{{ old('mentors') ?? $userAcademicWork->mentors}}</textarea>
                        <x-jet-input-error for="mentors" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="knowledge_area_id" value="{{ __('Knowledge area') }}" />
                        <select id="knowledge_area_id" name="knowledge_area_id" class="form-select w-full" required >
                            <option value="">Seleccione una área de conocimiento</option>
                            @forelse ($knowledgeAreas as $knowledgeArea)
                                <option value="{{ $knowledgeArea->id }}" {{ old('knowledge_area_id') == $knowledgeArea->id || optional($userAcademicWork->knowledgeArea)->id == $knowledgeArea->id ? "selected" : "" }}>{{ $knowledgeArea->name }}</option>
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="knowledge_area_id" class="mt-2" />
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
