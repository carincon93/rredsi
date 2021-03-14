<x-app-layout>

    <x-slot name="header">
        <div >
            <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
                <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                    {{ __('Node events') }}
                    <span class="text-base sm:text-2xl block text-purple-300">
                        Update node event info
                    </span>
                </h2>
            </div>
            <div class="col-start-1 col-end-7 md:col-end-8 md:col-span-3 xl:col-end-10 xl:col-span-2 m-auto">
                @can('index_node_event')
                <a href="{{ route('nodes.events.index', [$node]) }}">
                    <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back')}}
                    </div>
                </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar la información de un evento</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.events.update', [$node, $event]) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') ?? $event->name }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="location" value="{{ __('Location') }}" />
                        <x-jet-input id="location" class="block mt-1 w-full" type="text" max="191" name="location" value="{{ old('location') ?? $event->location }}" required />
                        <x-jet-input-error for="location" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea rows="20" id="description" name="description" class="form-textarea border-0 w-full" required >{{ old('description') ?? $event->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="start_date" value="{{ __('Start date') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }} " name="start_date" value="{{ old('start_date') ?? $event->start_date }}" required />
                        <x-jet-input-error for="start_date" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="end_date" value="{{ __('End date') }}" />
                        <x-jet-input id="end_date" class="block mt-1 w-full" type="date" min="1900" max="{{ date('Y') + 10 }} " name="end_date" value="{{ old('end_date') ?? $event->end_date }}" required />
                        <x-jet-input-error for="end_date" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="register_link" value="{{ __('Register link') }}" />
                        <x-jet-input id="register_link" class="block mt-1 w-full" type="url" max="191" name="register_link" value="{{ old('register_link') ?? $event->register_link }}" required />
                        <x-jet-input-error for="register_link" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="info_link" value="{{ __('Info link') }}" />
                        <x-jet-input id="info_link" class="block mt-1 w-full" type="url" max="191" name="info_link" value="{{ old('info_link') ?? $event->info_link }}" required />
                        <x-jet-input-error for="info_link" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Edit') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

