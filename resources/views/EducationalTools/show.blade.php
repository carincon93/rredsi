<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-left text-lg leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Educational tools') }}
            <span class="text-sm sm:text-3xl block text-purple-300">
                Show educational tool info
            </span>
        </h2>
        <div class="pl-2 lg:pl-0">
            @can('edit_educational_tool')
            <a href="{{ route('nodes.educational-institutions.faculties.educational-environments.educational-tools.edit', [$node, $educationalInstitution, $faculty, $educationalEnvironment, $educationalTool]) }}">
                <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-2 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit educational tool') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información de herramientas/equipos</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Educational environment') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ optional($educationalTool->educationalEnvironment)->name }}
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
                            {{ $educationalTool->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Description') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $educationalTool->description }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Qty') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $educationalTool->qty }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Is enabled?') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $educationalTool->is_enabled ? 'Si' : 'No' }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Is available?') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $educationalTool->is_available ? 'Si' : 'No' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
