<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo electrónico') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar contraseña') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="document_number" value="{{ __('Número de documento') }}" />
                <x-jet-input id="document_number" class="block mt-1 w-full" type="number" name="document_number" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="cellphone_number" value="{{ __('Número de celular') }}" />
                <x-jet-input id="cellphone_number" class="block mt-1 w-full" type="number" name="cellphone_number" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="document_type" value="{{ __('Tipo de documento') }}" />
                <select id="document_type" class="form-input w-full" name="document_type" required>
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="cc">Cédula de ciudadanía</option>
                    <option value="ti">Tarjeta de identidad</option>
                </select>
            </div>

            <p class="mt-4">Intereses</p>
            <div class="mt-4">
                <input id="investigar" class="form-checkbox mt-1" type="checkbox" name="interests[]" value="investigar" required />
                <label class="font-medium inline inline-flex text-gray-700 text-sm" for="investigar" >Investigar</label>
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya tiene una cuenta?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
