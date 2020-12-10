<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Academic programs') }}
            <span class="sm:block text-purple-300">
                Update academic program info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.index', [$node, $educationalInstitution, $faculty]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
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
                    <x-slot name="description">Editar la información del programa académico</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">

                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.academic-programs.update', [$node, $educationalInstitution, $faculty, $academicProgram]) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') ?? $academicProgram->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />
                        <x-jet-input id="code" class="block mt-1 w-full" type="number" maxlength="191" name="code" value="{{ old('code') ?? $academicProgram->code }}"  required />
                        <x-jet-input-error for="code" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="academic_level" value="{{ __('Academic level') }}" />
                        <select id="academic_level" name="academic_level" class="form-select w-full" required >
                            <option value="">Seleccione el nivel académico</option>
                            <option {{ old('academic_level') == "Técnico profesional" || $academicProgram->academic_level == "Técnico profesional" ? "selected" :"" }}  value="Técnico profesional">Técnico profesional</option>
                            <option {{ old('academic_level') == "Técnologo" || $academicProgram->academic_level == "Técnologo" ? "selected" : "" }} value="Tecnólogo">Tecnólogo</option>
                            <option {{ old('academic_level') == "Profesional" || $academicProgram->academic_level == "Profesional" ? "selected" : "" }} value="Profesional">Profesional</option>
                            <option {{ old('academic_level') == "Especialización técnica profesional" || $academicProgram->academic_level == "Especialización técnica profesional" ? "selected" : "" }} value="Especialización técnica profesional">Especialización técnica profesional</option>
                            <option {{ old('academic_level') == "Especialización tecnológica" || $academicProgram->academic_level == "Especialización tecnológica" ? "selected" : "" }} value="Especialización tecnológica">Especialización tecnológica</option>
                            <option {{ old('academic_level') == "Maestría" || $academicProgram->academic_level == "Maestría" ? "selected" : "" }} value="Maestría">Maestría</option>
                            <option {{ old('academic_level') == "Doctorado" || $academicProgram->academic_level == "Doctorado" ? "selected" : "" }} value="Doctorado">Doctorado</option>
                        </select>
                        <x-jet-input-error for="academic_level" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="start_date" value="{{ __('Start date') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="start_date" value="{{ old('start_date') ?? $academicProgram->start_date }}" required />
                        <x-jet-input-error for="start_date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="end_date" value="{{ __('End date') }}" />
                        <x-jet-input id="end_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }}" name="end_date" value="{{ old('end_date') ?? $academicProgram->end_date }}" required />
                        <x-jet-input-error for="end_date" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="modality" value="{{ __('Modality') }}" />
                        <select id="modality" name="modality" class="form-select w-full" required >
                            <option value="">Seleccione la modalidad</option>
                            <option {{ old('modality') == "Presencial" || $academicProgram->modality == "Presencial" ? "selected" : "" }}  value="Presencial">Presencial</option>
                            <option {{ old('modality') == "A distancia" || $academicProgram->modality == "A distancia" ? "selected" : "" }}  value="A distancia">A distancia</option>
                        </select>
                        <x-jet-input-error for="modality" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="daytime" value="{{ __('Daytime') }}" />
                        <select id="daytime" name="daytime" class="form-select w-full" required >
                            <option value="">Seleccione la jornada</option>
                            <option {{ old('daytime') == "Diurna" || $academicProgram->daytime == "Diurna" ? "selected" : "" }}  value="Diurna">Diurna</option>
                            <option {{ old('daytime') == "Mixta" || $academicProgram->daytime == "Mixta" ? "selected" : "" }}  value="Mixta">Mixta</option>
                            <option {{ old('daytime') == "Nocturna" || $academicProgram->daytime == "Nocturna" ? "selected" : "" }}  value="Nocturna">Nocturna</option>
                        </select>
                        <x-jet-input-error for="daytime" class="mt-2" />
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
