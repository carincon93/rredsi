<title>{{ "Crear usuario de la institución educativa"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-6 gap-4  xl:grid-cols-9 xl:gap-3">
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Educational institution users') }}
                    <span class="text-base sm:text-3xl block text-purple-300">
                        Add educational institution user
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                <a href="{{ route('nodes.educational-institutions.faculties.users.index', [$node, $educationalInstitution, $faculty]) }}">
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
                    <x-slot name="description">Añadir un usuario</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.users.store', [$node, $educationalInstitution, $faculty]) }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-jet-input-error for="password_confirmation" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="document_type" value="{{ __('Document type') }}" />
                        <select id="document_type" class="form-select w-full" name="document_type" required>
                            <option value="">Seleccione un tipo de documento</option>
                            <option value="cc" {{ old('document_type') == "cc" ? "selected" : "" }}>Cédula de ciudadanía</option>
                            <option value="ti" {{ old('document_type') == "ti" ? "selected" : "" }}>Tarjeta de identidad</option>
                            <option value="ce" {{ old('document_type') == "ce" ? "selected" : "" }}>Cédula de extranjería</option>
                        </select>
                        <x-jet-input-error for="document_type" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="document_number" value="{{ __('Document number') }}" />
                        <x-jet-input id="document_number" class="block mt-1 w-full" type="number" name="document_number" :value="old('document_number')" required />
                        <x-jet-input-error for="document_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="cellphone_number" value="{{ __('Cellphone number') }}" />
                        <x-jet-input id="cellphone_number" class="block mt-1 w-full" type="number" name="cellphone_number" :value="old('cellphone_number')" required />
                        <x-jet-input-error for="cellphone_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="interests" value="{{ __('Interests') }}" />
                        <textarea id="interests" name="interests" class="form-textarea border-0 w-full" value="{{ old('interests') }}" required >{{ old('interests') }}</textarea>
                        <x-jet-input-error for="interests" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is enabled?') }} </p>
                    <div class="block mt-4">
                        <label for="is_enabled_yes" class="flex items-center">
                            <input id="is_enabled_yes" value="1" type="radio" class="form-radio" name="is_enabled" {{ old('is_enabled') == 1 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_enabled_no" class="flex items-center">
                            <input id="is_enabled_no" value="0" type="radio" class="form-radio" name="is_enabled" {{ old('is_enabled') != null && old('is_enabled')  == 0 ? "checked" : "" }}>
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Roles') }} </p>
                    <div class="block mt-4">
                        @foreach ($roles as $role)
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" name="role_id[]" value="{{ $role->id }}" {{ old('role_id') == $role->id ? "checked" : "" }}>
                                <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                            </label>
                        @endforeach
                        <x-jet-input-error for="role_id" class="mt-2" />
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
