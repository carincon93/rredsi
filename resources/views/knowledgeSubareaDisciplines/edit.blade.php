<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Knowledge subarea disciplines') }}
            <span class="sm:block text-purple-300">
                Update knowledge subarea discipline info
            </span>
        </h2>
        <div>
            <a href="{{ route('knowledge-subarea-disciplines.index') }}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar la información de la disciplina de sub-área de conocimiento</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('knowledge-subarea-disciplines.update', $knowledgeSubareaDiscipline->id)}}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text"  max="191" name="name" value="{{ old('name') ?? $knowledgeSubareaDiscipline->name  }} " required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="knowledge_subarea_id" value="{{ __('Knowledge area') }}" />
                        <select id="knowledge_subarea_id" name="knowledge_subarea_id" class="block mt-1 p-4 w-full" required >
                            <option value="">Seleccione una área de conocimiento</option>
                            @forelse ($knowledgeSubareas as $knowledgeSubarea)
                                <option value="{{ $knowledgeSubarea->id }}" {{ old('knowledge_subarea_id') == $knowledgeSubareaDiscipline->id ? "selected" : "" || $knowledgeSubareaDiscipline->knowledgeSubarea()->id == $knowledgeSubarea->id ? "selected" : ""  }}>{{ $knowledgeSubarea->name }}</option>
                            @empty
                                <option value="">No knowledge subareas</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="knowledge_subarea_id" class="mt-2" />
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
