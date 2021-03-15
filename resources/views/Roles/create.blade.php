<title>{{'Crear rol'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-left text-2xlleading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Roles') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                   <a class="text-white font-weight underline" href="{{ route('roles.index') }}" >Lista de roles</a> / Crear rol
                </span>
            </h2>
        </div>
        @can('index_role')
        <a href="{{ route('roles.index') }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                {{ __('Back')}}
            </div>
        </a>
        @endcan
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">{{ __('Description') }}</x-slot>
                    <x-slot name="description">Add role</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" maxlength="255" name="name" value="{{ old('name') }}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea name="description" id="description" class="form-input rounded-md border-0 p-3.5 shadow-sm block mt-1 w-full" required>{{ old('description') }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p>{{ __('Permissions') }}</p>
                        @forelse ($permissions->chunk(5) as $chunk)
                            <div class="mt-1/6">
                                @foreach ($chunk as $permission)
                                    <div>
                                        <input id="{{ $permission->name }}" class="form-checkbox" type="checkbox" name="permissions[]" {{ old('permissions') == $permission->id ? 'checked' : '' }} value="{{ $permission->id }}" />
                                        <label class="font-medium inline inline-flex text-gray-700 text-sm ml-1" for="{{ $permission->name }}" >
                                            @if (explode('_', $permission->name)[0] == 'index')
                                                Listar {{ __(str_replace('_', ' ', $permission->model)) }}
                                            @endif
                                            @if (explode('_', $permission->name)[0] == 'show')
                                                Consultar {{ __(str_replace('_', ' ', $permission->model)) }}
                                            @endif
                                            @if (explode('_', $permission->name)[0] == 'create')
                                                Crear {{ __(str_replace('_', ' ', $permission->model)) }}
                                            @endif
                                            @if (explode('_', $permission->name)[0] == 'edit')
                                                Editar {{ __(str_replace('_', ' ', $permission->model)) }}
                                            @endif
                                            @if (explode('_', $permission->name)[0] == 'destroy')
                                                Eliminar {{ __(str_replace('_', ' ', $permission->model)) }}
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="mt-1/6">
                                <p>{{ __('No data recorded') }}</p>
                            </div>
                        @endforelse
                        <x-jet-input-error for="permissions" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
