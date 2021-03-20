<title>{{"Editar la información del sub-área de conocimiento $knowledgeSubarea->name "}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="m-auto col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-4">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Knowledge subareas') }}
                <span class="text-base sm:text-lg block text-purple-300">
                    <a class="text-white font-weight underline" href="{{ route('knowledge-subareas.index') }}">Lista de subáreas de conocimiento</a> / Editar subárea de conocimiento
                </span>
            </h2>
        </div>
        {{-- @can('index_knowledge_subarea')
        <a href="{{ route('knowledge-subareas.index') }}">
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
                    <x-slot name="description">Editar la información de la sub-área de conocimiento</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('knowledge-subareas.update', $knowledgeSubarea->id)}}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label class="mb-4" for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" max="191" name="name" value="{{ old('name') ?? $knowledgeSubarea->name  }} " required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="knowledge_area_id" value="{{ __('Knowledge area') }}" />
                        <select id="knowledge_area_id" name="knowledge_area_id" class="text-sm mr-10 focus:outline-none rounded-md border-0 p-3.5 shadow-sm block w-full" required >
                            <option value="">Seleccione una área de conocimiento</option>
                            @forelse ($knowledgeAreas as $knowledgeArea)
                                {{-- <option value="{{ $knowledgeArea->id }}" {{ old('knowledge_area_id') == $knowledgeArea->id ? "selected" : "" || $knowledgeSubarea->knowledgeArea->id == $knowledgeArea->id ? "selected" : ""  }}>{{ $knowledgeArea->name }}</option> --}}
                            @empty
                                <option value="">{{ __('No data recorded') }}</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="knowledge_area_id" class="mt-2" />
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

    <x-responsive-select :selectName="'knowledge_area_id'" />

    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>

