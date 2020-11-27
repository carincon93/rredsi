<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Academic works') }}
            <span class="sm:block text-purple-300">
                Update academic work info
            </span>
        </h2>
        <div>
            <a href="{{ route('academic-works.index') }}">
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
                    <x-slot name="description">Edita información académica</x-slot>
                </x-jet-section-title>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('academic-works.store', $academicWork->id ) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" min="" max="" name="title" value="{{ $academicWork->title }}" required />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="type" value="{{ __('Type') }}" />
                        <x-jet-input id="type" class="block mt-1 w-full" type="text" min="" max="" name="type" value="{{ $academicWork->type }}" required />
                        <x-jet-input-error for="type" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="authors" value="{{ __('Authors') }}" />
                        <x-jet-input id="authors" class="block mt-1 w-full" type="text" min="" max="" name="authors" value="{{ $academicWork->authors }}" required />
                        <x-jet-input-error for="authors" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="grade" value="{{ __('Grade') }}" />
                        <x-jet-input id="grade" class="block mt-1 w-full" type="text" min="" max="" name="grade" value="{{ $academicWork->grade }}" required />
                        <x-jet-input-error for="grade" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="mentors" value="{{ __('Mentors') }}" />
                        <x-jet-input id="mentors" class="block mt-1 w-full" type="text" min="" max="" name="mentors" value="{{ $academicWork->mentors }}" required />
                        <x-jet-input-error for="mentors" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="knowledge_area_id" value="{{ __('knowledge area') }}" />
                        <select id="knowledge_area_id" name="knowledge_area_id" class="block mt-1 p-4 w-full" value="{{ $academicWork->knowledge_area_id }}" required >
                            <option value="">Seleccione un área de conocimiento</option>
                            @forelse ($knowledgeAreas as $knowledgeArea)
                                <option value={{$knowledgeArea->id}}>  {{$knowledgeArea->name}} </option>
                            @empty
                                <option value="">No knowledge areas</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="knowledge_area_id" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="graduation_id" value="{{ __('Graduation') }}" />
                        <select id="graduation_id" name="graduation_id" class="block mt-1 p-4 w-full" value="{{ $academicWork->graduation_id }}" required >
                            <option value="">Seleccione</option>
                            @forelse ($graduations as $graduation)
                                <option value={{$graduation->id}}>  {{$graduation->state}} </option>
                            @empty
                                <option value="">No graduation</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="graduation_id" class="mt-2" />
                    </div>

                    <div class="mt-2">
                        <x-jet-label for="research_group_id" value="{{ __('Research group') }}" />
                        <select id="research_group_id" name="research_group_id" class="block mt-1 p-4 w-full" value="{{ $academicWork->research_group_id }}" required >
                            <option value="">Seleccione un grupo de investigación</option>
                            @forelse ($researchGroups as $researchGroup)
                                <option value={{$researchGroup->id}}>  {{$researchGroup->name}} </option>
                            @empty
                                <option value="">No research group</option>
                            @endforelse
                        </select>
                        <x-jet-input-error for="research_group_id" class="mt-2" />
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


</x-app-layout>
