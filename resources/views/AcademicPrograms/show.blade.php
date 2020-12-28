<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Academic programs') }}
            <span class="sm:block text-purple-300">
                Show academic program info
            </span> 
        </h2>
        <div>
            @can('edit_academic_program')
            <a href="{{ route('nodes.educational-institutions.faculties.academic-programs.edit', [$node, $educationalInstitution, $faculty, $academicProgram]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{__('Edit academic program') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del programa académico</h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Code') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->code }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Academic level') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->academic_level}}
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
            <div class="md:clo-span-1">
                
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Modality') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->modality }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Daytime') }}</h3>
                    <div class="mt-3 max-w-xl text-gray-600">
                        <p>
                            {{ $academicProgram->daytime }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Educational institution') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Start date') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->start_date }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('End date') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $academicProgram->end_date }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>