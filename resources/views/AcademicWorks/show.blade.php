<title>{{ "Detalles de $userAcademicWork->title"}}</title>

<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Academic works') }}
                <span class="sm:block text-purple-300">
                    Detalles del trabajo académico
                </span>
            </h2>
        </div>
        @can('edit_academic_work')
        <a href="{{ route('user.profile.user-graduations.user-academic-works.edit', [$userGraduation, $userAcademicWork]) }}">
            <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Edit academic work') }}
            </div>
        </a>
        @endcan
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del trabajo académico</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('title') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->title }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Authors') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->authors }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Grade') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->grade }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Mentors') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->mentors }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Knowledge areas') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->knowledgeareas }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Authors') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $userAcademicWork->authors }}
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
                            {{ optional($userAcademicWork->researchgroup)->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
