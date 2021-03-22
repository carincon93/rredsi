<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full border" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full border" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full border" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full border" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="document_type" value="{{ __('Document type') }}" />
                <select id="document_type" class="form-select w-full border" name="document_type" required>
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="cc">Cédula de ciudadanía</option>
                    <option value="ti">Tarjeta de identidad</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="document_number" value="{{ __('Document number') }}" />
                <x-jet-input id="document_number" class="block mt-1 w-full border" type="number" name="document_number" required />
            </div>

            <div class="mt-4">
                <x-jet-label class="mb-4" for="cellphone_number" value="{{ __('Cellphone number') }}" />
                <x-jet-input id="cellphone_number" class="block mt-1 w-full border" type="number" name="cellphone_number" required />
            </div>

            <p class="mt-4">{{ __('Interests') }}</p>
            <div class="mt-4">
                <small class="inline-block text-gray-500">Separe con comas cada interés</small>
                <textarea rows="4" id="interests" name="interests" class="form-textarea border w-full" value="{{ old('interests') }}" required >{{ old('interests') }}</textarea>
                <x-jet-input-error for="interests" class="mt-2" />
            </div>

            <x-drop-down-educational-institution-faculties :form="'yes'" />

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
