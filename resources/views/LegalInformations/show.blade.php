<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Legal information') }}
            <span class="sm:block text-purple-300">
                Show legal information info
            </span>
        </h2>
        <div>
            <a href="{{ route('legal-informations.edit', $legalInformation) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit legal information') }}
                </div>
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-2 md:gap-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Información legal</h3>
                </div>
                <div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Type') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $legalInformation->type }}
                            </p>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg mt-3">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Description') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $legalInformation->description }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>