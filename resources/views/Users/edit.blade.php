<title>{{"Editar la información del usuario $user->name"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Users') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    <a class="text-white font-weight underline" href="{{ route('users.index') }}" >Lista de usuarios</a> / Editar usuario
                </span>
            </h2>
        </div>
        @can('index_user')
        <a href="{{ route('users.index') }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                {{ __('Back')}}
            </div>
        </a>
        @endcan
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Crear un usuario</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('users.update', [$user]) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $user->name" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? $user->email" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="document_type" value="{{ __('Document type') }}" />
                        <select id="document_type" class="form-select w-full" name="document_type" required>
                            <option value="">Seleccione un tipo de documento</option>
                            <option value="cc" {{ old('document_type') == "cc" || $user->document_type == "cc" ? "selected" : "" }}>Cédula de ciudadanía</option>
                            <option value="ti" {{ old('document_type') == "ti" || $user->document_type == "ti" ? "selected" : "" }}>Tarjeta de identidad</option>
                            <option value="cc" {{ old('document_type') == "ce" || $user->document_type == "ce" ? "selected" : "" }}>Cédula de extranjería</option>
                        </select>
                        <x-jet-input-error for="document_type" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="document_number" value="{{ __('Document number') }}" />
                        <x-jet-input id="document_number" class="block mt-1 w-full" type="number" name="document_number" :value="old('document_number') ?? $user->document_number" required />
                        <x-jet-input-error for="document_number" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="cellphone_number" value="{{ __('Cellphone number') }}" />
                        <x-jet-input id="cellphone_number" class="block mt-1 w-full" type="number" name="cellphone_number" :value="old('cellphone_number') ?? $user->cellphone_number" required />
                        <x-jet-input-error for="cellphone_number" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="interests" value="{{ __('Interests') }}" />
                        <small class="inline-block text-gray-500">Separe con comas cada interés</small>
                        <textarea rows="20" id="interests" name="interests" class="form-textarea border-0 w-full" value="{{ old('interests') }}" required >@if(old('interests')){{ old('interests') }}@else @foreach(explode(',', implode(json_decode($user->interests))) as $interest){{$interest}}@endforeach @endif</textarea>
                        <x-jet-input-error for="interests" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Is enabled?') }} </p>
                    <div class="block mt-4">
                        <label for="is_enabled_yes" class="flex items-center">
                            <input id="is_enabled_yes" value="1" type="radio" class="form-radio" name="is_enabled" {{ old('is_enabled') == 1 || $user->is_enabled == 1 ? "checked" : "" }} />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Yes') }}</span>
                        </label>
                        <label for="is_enabled_no" class="flex items-center">
                            <input id="is_enabled_no" value="0" type="radio" class="form-radio" name="is_enabled" {{ old('is_enabled') != null && old('is_enabled') == 0 || $user->is_enabled == 0 ? "checked" : "" }} />
                            <span class="ml-2 text-sm text-gray-600">{{ __('No') }}</span>
                        </label>
                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Roles') }} </p>
                    <div class="block mt-4">
                        @foreach ($roles as $role)
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox" name="role_id[]" @if(is_array(old('role_id')) && in_array($role->id, old('role_id'))) checked @elseif($user->roles->pluck('id')->contains($role->id)) checked  @endif value="{{ $role->id }}" />
                                <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                            </label>
                        @endforeach
                        <x-jet-input-error for="role_id" class="mt-2" />
                    </div>

                    <p class="mt-1/6">{{ __('Educational institution faculty') }} </p>
                    <div class="block mt-4">
                        <x-drop-down-educational-institution-faculties :form="'yes'" />
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

    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
