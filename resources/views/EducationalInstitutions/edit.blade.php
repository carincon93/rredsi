<title>{{ "Editar información de la institución educativa $educationalInstitution->name "}}</title>

<x-app-layout>
    <x-slot name="header">
        <div class="grid grid-cols-6 gap-4  xl:grid-cols-9 xl:gap-3">
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Educational institutions') }}
                    <span class="text-base sm:text-3xl block text-purple-300">
                        Update educational institution info
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                @can('index_educational_institution')
                <a href="{{ route('nodes.educational-institutions.index', [$node]) }}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back')}}
                    </div>
                </a>
                @endcan
            </div>

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
                        <x-jet-label for="nit" value="{{ __('NIT') }}" />
                        <x-jet-input id="nit" class="block mt-1 w-full" type="number" min="" max="" name="nit" value="{{ old('nit') ?? $educationalInstitution->nit }}" required />
                        <x-jet-input-error for="nit" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="city" value="{{ __('City') }}" />
                        <select id="city" name="city" class="form-select w-full" required >
                            <option value="">Seleccione una ciudad</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['name'] }}" {{ old('city') == $city['name'] || $educationalInstitution->city == $city['name'] ? 'selected' : '' }}>{{ $city['name'] }}</option>
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
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="number" min="" maxlength="7" name="phone_number" value="{{ old('phone_number') ?? $educationalInstitution->phone_number }}" required />
                        <x-jet-input-error for="phone_number" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="website" value="{{ __('Website') }}" />
                        <x-jet-input id="website" class="block mt-1 w-full" type="text" min="" max="" name="website" value="{{ old('website') ?? $educationalInstitution->website }}" required />
                        <x-jet-input-error for="website" class="mt-2" />
                    </div>

                    <hr>

                    <div class="mt-4">
                        <x-jet-label for="administrator_id" value="{{ __('Educational institution admin') }}" />
                        <select id="administrator_id" name="administrator_id" class="form-select w-full" required >
                            <option value="">Seleccione el(la) delegado(a) de la institución educativa</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}" {{ old('administrator_id') == $admin->id || optional($educationalInstitution->administrator)->id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="administrator_id" class="mt-2" />
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




