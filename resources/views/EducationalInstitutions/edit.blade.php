<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Educational institutions') }}
            <span class="sm:block text-purple-300">
                Update educational institution info
            </span>
        </h2>
        <div>
            <a href="{{ route('educational-institutions.index') }}">
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
                    <x-slot name="description">Edita información académica</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('educational-institutions.update',$educationalInstitution->id) }}" >
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" min="" max="" name="name" value="{{ $educationalInstitution->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="nit" value="{{ __('Nit') }}" />
                        <x-jet-input id="nit" class="block mt-1 w-full" type="number" min="" max="" name="nit" value="{{ $educationalInstitution->nit }}" required />
                        <x-jet-input-error for="nit" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="city" value="{{ __('City') }}" />
                        <x-jet-input id="city" class="block mt-1 w-full" type="text" min="" max="" name="city" value="{{ $educationalInstitution->city }}" required />
                        <x-jet-input-error for="city" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" min="" max="" name="address" value="{{ $educationalInstitution->address }}" required />
                        <x-jet-input-error for="address" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="phone_number" value="{{ __('Phone number') }}" />
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="number" min="" max="" name="phone_number" value="{{ $educationalInstitution->phone_number }}" required />
                        <x-jet-input-error for="phone_number" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="website" value="{{ __('Website') }}" />
                        <x-jet-input id="website" class="block mt-1 w-full" type="text" min="" max="" name="website" value="{{ $educationalInstitution->website }}" required />
                        <x-jet-input-error for="website" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="administrator_id" value="{{ __('Educational institution admin') }}" />
                        <select id="administrator_id" name="administrator_id" class="block mt-1 p-4 w-full" value="{{ $educationalInstitution->administrator_id }}" required >
                            <option value='none'>Seleccione un administrador</option>
                            {{-- @forelse ($educationalInstitutionAdmins as $educationalInstitutionAdmin)
                                <option value={{ $educationalInstitutionAdmin->user->id }} > {{ $educationalInstitutionAdmin->user->name }} </option>
                            @empty
                                <option value="">No educational institutions admins</option>
                            @endforelse --}}
                        </select>
                        <x-jet-input-error for="administrator_id" class="mt-2" />
                    </div>


                    <div class="mt-2">
                        <x-jet-label for="node_id" value="{{ __('Node') }}" />
                        <select id="node_id" name="node_id" class="block mt-1 p-4 w-full" value="{{ $educationalInstitution->node_id }}" required >
                            <option value=''>Seleccione un Nodo </option>
                            @forelse ($nodes as $node)
                                <option selected="{{ $node->id == $educationalInstitution->node_id  ? 'selected' : '' }}" value={{$node->id}}>  {{$node->state}} </option>
                            @empty
                                <option value="">No Nodes</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="node_id" class="mt-2" />
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




