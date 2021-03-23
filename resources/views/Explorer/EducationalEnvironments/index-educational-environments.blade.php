<title>{{ "Lista de ambientes - ".config('app.name') }}</title>
<x-guest-layout>

    <x-guest-header :node="$node" image="">
        <x-slot name="title">
            <h1 class="text-3xl text-center sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg>
                    Explorer: Consulte la infraestructura o ambientes que se disponen en las instituciones educativas de la red
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
                {{ count($educationalEnvironments) }} resultado(s) para: {{ $search }}
        </x-slot>
        <x-slot name="actionButton">

        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 mt-4">
                @forelse ($educationalEnvironments->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $educationalEnvironment)
                            <div class="p-10 md:mb-0 mb-6 flex flex-col">
                                <div class="rounded bg-gray-50 p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <div style="padding-top: 0.2em; padding-bottom: 0.2rem" class="ml-2 inline-flex items-center space-x-1 text-xs px-2 bg-gray-200 text-gray-800 rounded-full mb-4">
                                            <div style="width: 0.4rem; height: 0.4rem" class="bg-gray-50 rounded-full"></div>
                                            <a href="{{ route('nodes.explorer.searchEducationalEnvironments', [$node, 'search-educational-environment' => $educationalEnvironment->type]) }}" class="text-gray-400 uppercase ml-2"><small>{{ $educationalEnvironment->type }}</small></a>
                                        </div>
                                    </div>
                                    <div class="flex-grow ">
                                        <a href="{{ route('nodes.explorer.searchEducationalEnvironments.showEducationalEnvironment', [$node, $educationalEnvironment]) }}" class="text-center">
                                            <h2 class="text-xl title-font font-medium mb-3">{{ $educationalEnvironment->name }}</h2>

                                            <p class="leading-relaxed text-sm text-justify">
                                                <small>{{ substr($educationalEnvironment->description, 0, 250) }}...</small>
                                            </p>
                                            <div class="mt-4 m-auto block">
                                                <x-jet-button>
                                                    {{ __('Show more') }}

                                                    <div class="ml-1 text-white">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </div>
                                                </x-jet-button>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="rounded bg-white p-4 transform translate-x-6 -translate-y-6 shadow">
                                    <p class="text-gray-400"><small>Institución educativa: {{ optional(optional($educationalEnvironment->educationalInstitutionFaculty)->educationalInstitution)->name }}</small></p>
                                    <p class="text-gray-400"><small>Facultad / centro de formación: {{ optional($educationalEnvironment->educationalInstitutionFaculty)->name }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</x-guest-layout>
