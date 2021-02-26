<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Knowledge subareas') }}
            <span class="text-base sm:text-3xl block text-purple-300">
                Show knowledge subarea info
            </span>
        </h2>
        <div>
            @can('edit_knowledge_subarea')
            <a href="{{ route('knowledge-subareas.edit', [$knowledgeSubarea]) }}">
                <div class="w-auto text-center text-base  items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 sm:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Edit knowledge subarea') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap" id="tabs-id">
                <div class="w-full">
                    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-blue-900" onclick="changeActiveTab(event,'tab-profile')">
                                {{ __('Knowledge subarea') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-settings')">
                                {{ __('Knowledge area') }} 
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-options')">
                                {{ __('Knowledge subarea disciplines') }}
                            </a>
                        </li>
                    </ul>
                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">

                            <div class="block" id="tab-profile">
                                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                    <div class="md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Información de la sub-área de conocimiento</h3>
                                        </div>
                                        <div>
                                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                    <p>
                                                        {{ $knowledgeSubarea->name }}
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
                                </div>
                            </div>
                            <div class="hidden" id="tab-settings">
                                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                    <div class="md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Información del área de conocimiento</h3>
                                        </div>

                                        <div>
                                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                    <p>
                                                        {{ optional($knowledgeSubarea->knowledgeArea)->name }}
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
                                </div>
                            </div>
                            <div class="hidden" id="tab-options">
                                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                    <div class="md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Información de las disciplinas de sub-áreas de conocimiento</h3>
                                        </div>

                                        <div>
                                            @foreach ($knowledgeSubarea->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                                                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                                    <h3 class="text-lg font-medium text-gray-900">{{ __('Name') }}</h3>
                                                    <div class="mt-3 max-w-xl text-sm text-gray-600">
                                                        <p>
                                                            {{ $knowledgeSubareaDiscipline->name }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="hidden sm:block">
                                                    <div class="py-8">
                                                        <div class="border-t border-gray-200"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



