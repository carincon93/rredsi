<title>{{ "Crear herramienta educativa"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-6 gap-4  xl:grid-cols-9 xl:gap-3">
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-lg leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Educational tools') }}
                    <span class="text-sm sm:text-3xl block text-purple-300">
                        Add educational tool info
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.educational-tools.index', [$node, $educationalInstitution, $faculty, $educationalEnvironment]) }}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back') }}
                    </div>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Añadir un equipo/herramienta</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.educational-environments.educational-tools.store', [$node, $educationalInstitution, $faculty, $educationalEnvironment]) }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="form-textarea border-0 w-full" value="{{ old('description') }}" required >{{ old('description') }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="qty" value="{{ __('Qty') }}" />
                        <x-jet-input id="qty" class="block mt-1 w-full" type="number" max="9999999999" name="qty" value="{{ old('qty') }}" required />
                        <x-jet-input-error for="qty" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is enabled?' ) }} </p>
                    <div class="mt-4">
                        <input class="form-check-input" type="radio" name="is_enabled" id="is_enable_yes" {{ old('is_enabled') == 1 ? "checked" : "" }} value="1" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_enable_yes">Si</label>

                        <input class="form-check-input" type="radio" name="is_enabled" id="is_enabled_no" {{ old('is_enabled') == 0 ? "checked" : "" }} value="0" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_enabled_no">No</label>

                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is available?') }}</p>
                    <div class="mt-4">
                        <input class="form-check-input" type="radio" name="is_available" id="is_available_yes" {{ old('is_available') == 1 ? "checked" : "" }} value="1" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_available_yes">Si</label>

                        <input class="form-check-input" type="radio" name="is_available" id="is_available_no" {{ old('is_available') == 0 ? "checked" : "" }} value="0" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_available_no">No</label>

                        <x-jet-input-error for="is_available" class="mt-2" />
                    </div>

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
</x-app-layout>
