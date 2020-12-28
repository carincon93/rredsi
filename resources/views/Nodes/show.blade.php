<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Nodes') }}
            <span class="sm:block text-purple-300">
                Show node info
            </span>
        </h2>
        <div>
            @can('edit_node')
            <a href="{{ route('nodes.edit', [$node]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit node') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>
    
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-2 md:gap-4">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Información del nodo <span class="text-capitalize">{{ $node->state }}</span></h3>
            </div>
            <div>
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $node->administrator->name }}
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
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Cellphone number') }}</h3>
                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                        <p>
                            {{ $node->administrator->cellphone_number }}
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
                            {{ $node->administrator->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
