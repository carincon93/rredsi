<style>
/* CHECKBOX TOGGLE SWITCH */
/* @apply rules for documentation, these do not work as inline style */
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    }
    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }
</style>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div>
                <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full border" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                {{-- <x-jet-input-error for="name" class="mt-2" /> --}}
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

            <div class="mt-4">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="type_business" id="type_business" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <label for="toggle" class="text-xs text-gray-700">Usuario tipo empresa ?.</label>
                </div>
            </div>

            <div id="tab-hidden">
                <p class="mt-4">{{ __('Interests') }}</p>
                <div class="mt-4">
                    <small class="inline-block text-gray-500">Separe con comas cada interés</small>
                    <textarea rows="4" id="interests" name="interests" class="form-textarea border w-full" value="{{ old('interests') }}" required >{{ old('interests') }}</textarea>
                    <x-jet-input-error for="interests" class="mt-2" />
                </div>

                <x-drop-down-research-team :form="'yes'" />
            </div>


            <div class="hidden mt-4" id="tab-business">

                <p class="mt-4 mb-4">{{ __('Datos de la empresa') }}</p>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                        Nit
                      </label>
                      <input name="nit" id="nit" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="8-0000000">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                        Name
                      </label>
                      <input name="name_business" id="name_business" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Enterprise">
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        address
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address_business" name="address_business" type="address" placeholder="Calle #">
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        celphone number
                      </label>
                      <input name="cellphone_number_business" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cellphone_number_business" type="number" placeholder="">
                    </div>
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                            email
                        </label>
                        <input name="email_business" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email_business" type="email" placeholder="example@.com">
                      </div>
                  </div>
                  <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                        <input type="checkbox" name="data_authorization" id="data_authorization" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                    </div>
                    <label for="toggle" class="text-xs text-gray-700">Data authorization.</label>
                  </div>

                </div>


            </div>

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

<script>
        var checkbox  = document.getElementById("type_business");

        checkbox.addEventListener( 'change', function() {

            if(this.checked) {
                document.getElementById("tab-business").classList.remove("hidden");
                document.getElementById("tab-hidden").classList.add("hidden");
            }else{
                document.getElementById("tab-business").classList.add("hidden");
                document.getElementById("tab-hidden").classList.remove("hidden");
            }

        });

</script>
