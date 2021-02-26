<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-6 gap-4  xl:grid-cols-9 xl:gap-3">
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Research groups') }}
                    <span class="text-base sm:text-3xl block text-purple-300">
                        Add research group
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                <a href="{{ route('nodes.educational-institutions.faculties.research-groups.index', [$node, $educationalInstitution, $faculty]) }}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back')}}
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
                    <x-slot name="description">Añadir un grupo de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.research-groups.store', [$node, $educationalInstitution, $faculty]) }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" max="191" name="email" value="{{ old('email') }}" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="leader" value="{{ __('Leader') }}" />
                        <x-jet-input id="leader" class="block mt-1 w-full" type="text" max="191" name="leader" value="{{ old('leader') }}" required />
                        <x-jet-input-error for="leader" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="gruplac" value="{{ __('Gruplac') }}" />
                        <x-jet-input id="gruplac" class="block mt-1 w-full" type="url" max="191" name="gruplac" value="{{ old('gruplac') }}" required />
                        <x-jet-input-error for="gruplac" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="minciencias_code" value="{{ __('Minciencias code') }}" />
                        <x-jet-input id="minciencias_code" class="block mt-1 w-full" type="text" max="191" name="minciencias_code" value="{{ old('minciencias_code') }}" required />
                        <x-jet-input-error for="minciencias_code" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="minciencias_category" value="{{ __('Minciencias category') }}" />
                        <select id="minciencias_category" name="minciencias_category" class="form-select w-full" required >
                            <option value="">Seleccione una categoría Minciencias</option>
                            <option {{ old('minciencias_category') == "A" ? "selected" : ""  }} value="A">A</option>
                            <option {{ old('minciencias_category') == "B" ? "selected" : "" }} value="B">B</option>
                        </select>
                        <x-jet-input-error for="minciencias_category" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="website" value="{{ __('Website') }}" />
                        <x-jet-input id="website" class="block mt-1 w-full" type="url" max="191" name="website" value="{{ old('website') }}" required />
                        <x-jet-input-error for="website" class="mt-2" />
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
