<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Research lines') }}
            <span class="sm:block text-purple-300">
                Add research line info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-lines.index', [$node, $educationalInstitution, $faculty, $researchGroup]) }}">
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
                    <x-slot name="description">Añadir una línea de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.research-groups.research-lines.store', [$node, $educationalInstitution, $faculty, $researchGroup]) }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="objectives" value="{{ __('Objectives') }}" />
                        <textarea id="objectives" name="objectives" class="form-textarea border-0 w-full" value="{{ old('objectives') }}" required >{{ old('objectives') }}</textarea>
                        <x-jet-input-error for="objectives" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="mission" value="{{ __('Mission') }}" />
                        <textarea id="mission" name="mission" class="form-textarea border-0 w-full" value="{{ old('mission') }}" required >{{ old('mission') }}</textarea>
                        <x-jet-input-error for="mission" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="vision" value="{{ __('Vision') }}" />
                        <textarea id="vision" name="vision" class="form-textarea border-0 w-full" value="{{ old('vision') }}" required >{{ old('vision') }}</textarea>
                        <x-jet-input-error for="vision" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="achievements" value="{{ __('Achievements') }}" />
                        <textarea id="achievements" name="achievements" class="form-textarea border-0 w-full" value="{{ old('achievements') }}" required >{{ old('achievements') }}</textarea>
                        <x-jet-input-error for="achievements" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="knowledge_area_id" value="{{ __('Knowledge area') }}" />
                        <select id="knowledge_area_id" name="knowledge_area_id" class="form-select w-full" value="{{ old('knowledge_area_id') }}" required >
                            <option value="">Seleccione una área de conocimiento</option>
                            @forelse ($knowledgeAreas as $knowledgeArea)
                                <option {{ old('knowledge_area_id') == $knowledgeArea->id ? "selected" : "" }} value="{{ $knowledgeArea->id }}">{{ $knowledgeArea->name }}</option>
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="knowledge_area_id" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
