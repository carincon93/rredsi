<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Researchers') }}
            <span class="sm:block text-purple-300">
                Add researcher info
            </span>
        </h2>
        <div>
            <a href="{{ route('researchers.index') }}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
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
                    <x-slot name="description">Añade información</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('researchers.store') }}">
                    @csrf

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" min="" max="" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" min="" max="" name="email" value="{{ old('email') }}" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="document_type" value="{{ __('Document type') }}" />
                        <select id="document_type" name="document_type" class="block mt-1 p-4 w-full" value="{{ old('document_type') }}" required >
                            <option  value="">Seleccione el tipo de documento</option>
                            <option {{ old('document_type')== "CC" ? "selected" : "" }} value="CC">Cédula de ciudadanía</option>
                            <option {{ old('document_type')== "CE" ? "selected" : "" }} value="CE">Cédula de extranjería</option>
                            <option {{ old('document_type')== "TI" ? "selected" : "" }} value="TI">Tarjeta de identidad</option>
                        </select>
                        <x-jet-input-error for="document_type" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="document_number" value="{{ __('Document number') }}" />
                        <x-jet-input id="document_number" class="block mt-1 w-full" type="number" min="" max="" name="document_number" value="{{ old('document_number') }}" required />
                        <x-jet-input-error for="document_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="cellphone_number" value="{{ __('Cellphone number') }}" />
                        <x-jet-input id="cellphone_number" class="block mt-1 w-full" type="number" min="" max="" name="cellphone_number" value="{{ old('cellphone_number') }}" required />
                        <x-jet-input-error for="cellphone_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="status" class="block mt-1 p-4 w-full" value="{{ old('status') }}" required >
                            <option value="">Seleccione el estado</option>
                            <option {{ old('status') == "Aceptado" ? "selected" : "" }} value="Aceptado">Aceptado</option>
                            <option {{ old('status') == "En espera" ? "selected" : "" }} value="En espera">En espera</option>
                            <option {{ old('status') == "Rechazado" ? "selected" : "" }} value="Rechazado">Rechazado</option>
                        </select>
                        <x-jet-input-error for="status" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="interests" value="{{ __('Interests') }}" />
                        <textarea id="interests" name="interests" class="block mt-1 p-4 w-full" value="{{ old('interests') }}" required >

                        </textarea>
                        <x-jet-input-error for="interests" class="mt-2" />
                    </div>

                    <p class="mt-4">{{ __('Is enabled?' ) }} </p>
                    <div class="mt-4">
                        <input class="form-check-input" type="radio" name="is_enabled" id="is_enable_yes" {{ old('is_enable_yes') == 1 ? 'checked' : '' }} value="1" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_enable_yes">Si</label>

                        <input class="form-check-input" type="radio" name="is_enabled" id="is_enabled_no" {{ old('is_enabled_no') == 0 ? 'checked' : '' }} value="0" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_enabled_no">No</label>

                        <x-jet-input-error for="is_enabled" class="mt-2" />
                    </div>


                    <p class="mt-4">{{ __('Research team' ) }} </p>
                    @forelse ($researchTeams as $researchTeam)
                    <div class="mt-4">
                        <input class="form-check-input" type="checkbox" name="research_team_id[]" {{ old('research_team_id[]')}} id={{$researchTeam->name}} value={{$researchTeam->id}} />
                        <label   label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ $researchTeam->name }}">{{ $researchTeam->name }}</label>
                        <x-jet-input-error for="research_team_id" class="mt-2" />
                    </div>
                    @empty
                        <p class="mt-4 text-gray-700 text-sm ml-1">{{ __('No research teams data' ) }} </p>
                    @endforelse


                    <p class="mt-4">{{ __('Is external?' ) }} </p>
                    <div class="mt-4">
                        <input class="form-check-input" type="radio" name="is_external" id="is_external_yes" {{ old('is_external_yes') == 1 ? 'checked' : '' }} value="1" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_external_yes">Si</label>

                        <input class="form-check-input" type="radio" name="is_external" id="is_external_no" {{ old('is_external_no') == 0 ? 'checked' : '' }} value="0" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_external_no">No</label>

                        <x-jet-input-error for="is_external" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="cvlac" value="{{ __('Cvlac ') }}" />
                        <x-jet-input id="cvlac" class="block mt-1 w-full" type="url" min="" max="" name="cvlac" value="{{ old('cvlac') }}" required />
                        <x-jet-input-error for="cvlac" class="mt-2" />
                    </div>


                    <p class="mt-4">{{ __('Is accepted?' ) }} </p>
                    <div class="mt-4">
                        <input class="form-check-input" type="radio" name="is_accepted" id="is_accepted_yes" {{ old('is_accepted_yes') == 1 ? 'checked' : '' }} value="1" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_accepted_yes">Si</label>

                        <input class="form-check-input" type="radio" name="is_accepted" id="is_accepted_no" {{ old('is_accepted_no') == 0 ? 'checked' : '' }} value="0" />
                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="is_accepted_no">No</label>

                        <x-jet-input-error for="is_accepted" class="mt-2" />
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

