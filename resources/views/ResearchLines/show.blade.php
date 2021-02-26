<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Researcher lines') }}
            <span class="text-base sm:text-3xl block text-purple-300">
                Show researcher line info
            </span>
        </h2>
        <div>
            @can('edit_research_line')
            <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-lines.edit', [$node, $educationalInstitution, $faculty, $researchGroup, $researchLine]) }}">
                <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit research line') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información de lineas de investigadores</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Knowledge area') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ optional($researchLine->knowledgeArea)->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Research group') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ optional($researchLine->researchGroup)->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $researchLine->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Objectives') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $researchLine->objectives }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Mission') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $researchLine->mission }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Vision') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $researchLine->vision }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Achievements') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $researchLine->achievements }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
