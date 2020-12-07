<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Research outputs') }}
            <span class="sm:block text-purple-300">
                Update research output info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
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
                    <x-slot name="description">Editar la información del producto de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.update', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project, $researchOutput]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" min="" max="" name="title" value="{{ old('title') ?? $researchOutput->title }}" required />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>
                    
                    <div class="mt-4">
                        <x-jet-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" class="form-textarea border-0 w-full" value="{{ old('description') ?? $researchOutput->description }}" required >{{ old('description') ?? $researchOutput->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="typology" value="{{ __('Minciencias typology') }}" />
                        <select id="typology" name="typology" class="form-select w-full" required >
                            <option value="">Seleccione una sub-tipología Minciencias</option>
                            @foreach ($mincienciasTypologies as $mincienciasTypology)
                                <option value="{{ $mincienciasTypology['name'] }}"  {{ old('typology') == $mincienciasTypology['name'] || $researchOutput->typology == $mincienciasTypology['name'] ? "selected" : "" }}>{{ $mincienciasTypology['name'] }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="typology" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="file" value="{{ __('File') }}" />
                        <x-jet-input id="file" class="block mt-1 w-full" type="file" accept="application/pdf" name="file" value="{{ old('file') ?? $researchOutput->file }}" />
                        <x-jet-input-error for="file" class="mt-2" />
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
