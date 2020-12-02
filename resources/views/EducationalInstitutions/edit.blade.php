<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Educational institutions') }}
            <span class="sm:block text-purple-300">
                Update educational institution info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.index', [$node]) }}">
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
                    <x-slot name="description">Editar la información de la institución educativa</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.update', [$node, $educationalInstitution]) }}" >
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" min="" max="" name="name" value="{{ old('name') ?? $educationalInstitution->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="nit" value="{{ __('Nit') }}" />
                        <x-jet-input id="nit" class="block mt-1 w-full" type="number" min="" max="" name="nit" value="{{ old('nit') ?? $educationalInstitution->nit }}" required />
                        <x-jet-input-error for="nit" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="city" value="{{ __('City') }}" />
                        <select id="city" name="city" class="form-select w-full" required >
                            <option value="">Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['name'] }}" {{ old('city') == $city['name'] || $educationalInstitution->city == $city['name'] ? "selected" : "" }}>{{ $city['name'] }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" min="" max="" name="address" value="{{ old('address') ?? $educationalInstitution->address }}" required />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone_number" value="{{ __('Phone number') }}" />
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="number" min="" max="" name="phone_number" value="{{ old('phone_number') ?? $educationalInstitution->phone_number }}" required />
                        <x-jet-input-error for="phone_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="website" value="{{ __('Website') }}" />
                        <x-jet-input id="website" class="block mt-1 w-full" type="text" min="" max="" name="website" value="{{ old('website') ?? $educationalInstitution->website }}" required />
                        <x-jet-input-error for="website" class="mt-2" />
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




