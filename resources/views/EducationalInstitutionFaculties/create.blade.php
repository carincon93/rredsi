<title>{{ "Crear Facultad / Centro de formación"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div >
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Educational institution faculties') }}
                    <span class="text-base sm:text-2xl block text-purple-300">
                        Add educational institution faculty
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                <a href="{{ route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution]) }}">
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
                    <x-slot name="description">Crear facultad</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.store', [$node, $educationalInstitution]) }}">
                    @csrf

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" min="" max="" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" min="" max="" name="email" value="{{ old('email') }}" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="phone_number" value="{{ __('Phone number') }}" />
                        <x-jet-input id="phone_number" class="block mt-1 w-full" type="number" min="" max="" name="phone_number" value="{{ old('phone_number') }}" required />
                        <x-jet-input-error for="phone_number" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="ext" value="{{ __('Ext') }}" />
                        <x-jet-input id="ext" class="block mt-1 w-full" type="number" min="" max="" name="ext" value="{{ old('ext') }}" />
                        <x-jet-input-error for="ext" class="mt-2" />
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

