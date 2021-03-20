<x-guest-layout>

    <x-guest-header :node="$node" image="">
        <x-slot name="title">
            <h1 class="text-3xl text-center sm:text-3xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg>
                    Connect: Conecte con jóvenes investigadores
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            {{ count($node->roleMembers) }} resultado(s) para la búsqueda: {{ $academicProgram->name }}
        </x-slot>
        <x-slot name="actionButton">

        </x-slot>
    </x-guest-header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 mt-4">
                @forelse ($node->roleMembers as $roleMember)

                    <x-jet-section-border />

                    <div class="p-4 flex">
                        @if ($roleMember->profile_photo_url)
                            <img class="h-10 w-10 rounded-full" src="{{ $roleMember->profile_photo_url }}" alt="{{ $roleMember->name }}" />
                        @else
                            <div class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-indigo-200 text-blue-800 mb-5 flex-shrink-0 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                        <div class="ml-8 w-full">
                            <div>
                                <p class="pre-line-initial text-2xl mb-4">
                                    <a href="{{ route('nodes.explorer.searchRoles.showUser', [$node, $roleMember]) }}">{{ $roleMember->name }}</a>
                                </p>
                                <p class="pre-line-initial text-justify mb-2">
                                    {{ __('Biography') }}:
                                    <br>
                                    <small>
                                        @if ($roleMember->biography)
                                            {{ substr($roleMember->biography, 0, 550) }}...
                                        @else
                                            {{ __('No data recorded') }}
                                        @endif
                                    </small>
                                </p>
                                <p class="pre-line-initial mt-2 mb-2">
                                    {{ __('Interests') }}:
                                    <br>
                                    <small>
                                        @forelse (json_decode($roleMember->interests) as $interests)
                                            {{ $interests }}
                                        @empty
                                            {{ __('No data recorded') }}
                                        @endforelse
                                    </small>
                                </p>
                                <p class="pre-line-initial mt-2 mb-2">
                                    {{ __('CvLac') }}:
                                    <br>
                                    <small>
                                        @if ($roleMember->cvlac)
                                            <a href="{{ $roleMember->cvlac }}" target="_blank" class="underline">
                                                Ver CvLac
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="inline-flex h-4 text-gray-200">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        @else
                                            <p>{{ __('No data recorded') }}
                                        @endif
                                    </small>
                                </p>
                                <p class="pre-line-initial mt-2">Información académica:</p>
                                @forelse (optional($roleMember->userGraduations)->take(3)->chunk(3) as $chunk)
                                    <div class="mt-4 md:grid md:grid-cols-3 md:gap-4">
                                        @foreach ($chunk as $graduation)
                                            <div class="md:mb-0 mb-6 flex flex-col">
                                                <div class="rounded bg-gray-50 p-4 transform shadow">
                                                    <div class="flex-grow ">
                                                        <h2 class="text-xl title-font font-medium mb-3">
                                                            <a href="{{ route('nodes.explorer.searchRoles', [$node, $graduation->academicProgram]) }}">
                                                                {{ optional($graduation->academicProgram)->academic_level }} en {{ optional($graduation->academicProgram)->name }}
                                                            </a>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <p class="pre-line-initial mt-12 ml-16">{{ __('No data recorded') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>
