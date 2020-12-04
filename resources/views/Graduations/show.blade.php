<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Graduations') }}
            <span class="sm:block text-purple-300">
                Show graduation info
            </span>
        </h2>
        <div>
            <a href="{{ route('user.profile.user-graduations.edit', [$userGraduation]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit graduation') }}
                </div>
            </a>
        </div>
    </x-slot>
    
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium text-gray-900">Información de grado</h3>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Academic program') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $userGraduation->academicProgram->name }}
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
            
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('User') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $userGraduation->user->id }}
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
            
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Is graduated?') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $userGraduation->is_graduated ? 'Si' : 'No' }}
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
            
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Year') }}</h3>
                        <div class="mt-3 max-w-xl text-sm text-gray-600">
                            <p>
                                {{ $userGraduation->year }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>