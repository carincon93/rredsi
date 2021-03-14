<title>{{ "Detalles de la Facultad / Centro de formación $faculty->name"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Educational institution faculties') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                   Editar información de la facultad / centro de formación
                </span>
            </h2>
        </div>
        @can('edit_educational_institution_faculty')
        <a href="{{ route('nodes.educational-institutions.faculties.edit', [$node, $educationalInstitution, $faculty]) }}">
            <div class="w-auto text-center text-sm sm:text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Edit educational institution faculty') }}
            </div>
        </a>
        @endcan
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="md:grid md:grid-cols-2 md:gap-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Información de la  facultad</h3>
                </div>
                <div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $faculty->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-2 md:gap-4">
                <div>

                </div>
                <div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Email') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $faculty->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-2 md:gap-4">
                <div>

                </div>
                <div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Phone number') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $faculty->phone_number }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <div class="md:grid md:grid-cols-2 md:gap-4">
                <div>

                </div>
                <div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Ext') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $faculty->ext }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
