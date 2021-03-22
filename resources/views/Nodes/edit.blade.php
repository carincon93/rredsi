<title>{{"Editar la información del nodo $node->state - ".config('app.name') }}</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Nodes') }}
            <span class="sm:block text-lg text-purple-300">
                <a class="text-white font-weight underline" href="{{ route('nodes.index') }}">Lista de los nodos</a> / Editar nodo
            </span>
        </h2>
        {{-- @can('index_node')
        <a href="{{ route('nodes.index') }}">
            <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                {{ __('Back')}}
            </div>
        </a>
        @endcan --}}
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">

            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar información del nodo</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.update',$node->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label class="mb-4" for="state" value="{{ __('State') }}" />
                        <x-jet-input id="state" class="block mt-1 w-full" type="text" min="" max="" name="state" value="{{ $node->state }}" required />
                        <x-jet-input-error for="state" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label class="mb-4" for="logo" value="{{ __('Logo') }}" />
                        <x-jet-input id="logo" class="block mt-1 w-full overflow-hidden" type="file" accept="image/*" name="logo" value="{{ old('logo') }}" />
                        @if (Storage::disk('public')->exists($node->logo))
                            <a href="{{ url("storage/$node->logo") }}" class="mt-4 inline-flex text-blue-600 underline" target="_black">Ver logo</a>
                            <x-jet-section-border />
                        @endif
                        <x-jet-input-error for="logo" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label class="mb-4" for="administrator_id" value="{{ __('Node admin') }}" />
                        <select id="administrator_id" name="administrator_id" class="form-select w-full" required >
                            <option value="">Seleccione un administrador de nodo</option>
                            @forelse ($users as $user)
                                <option {{ $user->id == old('administrator_id') || $user->id == $node->administrator->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="administrator_id" class="mt-2" />
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

    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
