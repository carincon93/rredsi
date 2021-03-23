<title>{{ "Detalles del ambiente - ".config('app.name') }}</title>

<x-guest-layout>

    <x-guest-header :node="$node" image="">
        <x-slot name="title">
            <h1 class="text-3xl text-center sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline capitalize">
                    {{ $educationalEnvironment->name }}
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow mt-1/12">
                <p class="text-gray-400"><small>Institución educativa: {{ optional(optional($educationalEnvironment->educationalInstitutionFaculty)->educationalInstitution)->name }}</small></p>
                <p class="text-gray-400"><small>Facultad / centro de formación: {{ optional($educationalEnvironment->educationalInstitutionFaculty)->name }}</small></p>
            </div>
        </x-slot>
        <x-slot name="actionButton">

        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 mt-4">

                <h1 class="text-2xl">{{ __('Description') }}</h1>
                <p class="mt-4 whitespace-pre-line">{{ $educationalEnvironment->description ?? __('No data recorded') }}</p>

                <x-jet-section-border />

                <h1 class="text-2xl">{{ __('Type') }}</h1>
                <p class="mt-4 whitespace-pre-line">{{ $educationalEnvironment->type ?? __('No data recorded') }}</p>

                <x-jet-section-border />

                <h1 class="text-2xl mt-12 mb-4">{{ __('Knowledge subarea disciplines') }}</h1>
                @forelse ($educationalEnvironment->knowledgeSubareaDisciplines as $knowledgeSubareaDiscipline)
                    <a href="{{ route('nodes.explorer.searchEducationalEnvironments', [$node, 'search-educational-environment' => $knowledgeSubareaDiscipline->knowledgeSubarea->knowledgeArea->name]) }}" class="ml-1 underline">
                        {{ $knowledgeSubareaDiscipline->knowledgeSubarea->knowledgeArea->name }}
                    </a>
                @empty
                    <p class="mt-12 ml-16">{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-footer :legalInformations="$legalInformations" />

</x-guest-layout>
