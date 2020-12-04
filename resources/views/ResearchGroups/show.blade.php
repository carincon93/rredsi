<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Research groups') }}
            <span class="sm:block text-purple-300">
                Show research group info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.research-groups.edit', [$node, $educationalInstitution, $researchGroup]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit research group') }}
                </div>
            </a>
        </div>
    </x-slot>
    
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium text-gray-900">Información del grupo de investigación</h3>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->name }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Email') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->email }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Leader') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->leader }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('GrupLac') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->gruplac }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Minciencias code') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->minciencias_code }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Minciencias category') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->minciencias_category }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Website') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->website }}
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
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Educational Institution') }}</h3>
                            <div class="mt-3 max-w-xl text-sm text-gray-600">
                                <p>
                                    {{ $researchGroup->educationalInstitution->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>