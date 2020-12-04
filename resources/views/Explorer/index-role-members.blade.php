<x-guest-layout>

    <x-guest-header :node="$node" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-14 pt-4" style="background: url(/storage/images/explorer.png)">
                <div class="mt-8 dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mt-4 h-64" style="background: url(/storage/images/networking.jpg)">
                    <div class="p-6">
                        <div class="flex items-center mt-4">
                            <div>
                                <h1 class="text-5xl text-center leading-none text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#000" />
                                    </svg>
                                    Explorer: Fortalezca los resultados de su proyecto conectando con jóvenes investigadores de otras áreas de conocimiento y de otras instituciones educativas
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 mt-4">
                <h1 class="text-center text-2xl mt-4 mb-12">{{ $academicProgram->name }}</h1>
                @foreach ($node->roleMembers->chunk(3) as $chunk)
                    <div class="md:grid md:grid-cols-3 md:gap-4">
                        @foreach ($chunk as $roleMember)
                            <div class="shadow p-2">
                                <p class="text-center text-2xl mb-4">{{ $roleMember->name }}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="m-auto h-7 text-gray-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                                @forelse ($roleMember->userGraduations->take(2) as $userGraduation)
                                    <p class="text-gray-400 mt-4">
                                        {{ $userGraduation->is_graduated ? 'Profesional del programa ' : 'Estudiante del programa' }} {{ $userGraduation->academicProgram->name }}
                                        <br>
                                        <small>{{ $userGraduation->academicProgram->educationalInstitution->name }}</small>
                                    </p>
                                @empty
                                    <p class="mt-4"><small>{{ __('No data recorded' ) }}</small></p>
                                @endforelse
                                <a href="{{ route('nodes.explorer.contactForm', [$node, $roleMember]) }}">
                                    <div class="mt-3 flex items-center text-sm font-semibold text-blue-900 justify-center">
                                        <div>Contactar</div>
                
                                        <div class="ml-1 text-blue-900">
                                            <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>