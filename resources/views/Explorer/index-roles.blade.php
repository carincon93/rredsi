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
                @forelse ($node->academicPrograms->chunk(3) as $chunk)
                    <div class="flex items-center justify-between mb-4">
                        @foreach ($chunk as $academicProgram)
                            <div>
                                <a href="{{ route('nodes.explorer.searchRoles', [$node, $academicProgram]) }}">
                                    <span class="underline">{{ $academicProgram->name }}</span>
                                    <p class="text-gray-400"><small>{{ $academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}</small></p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p>{{ __('No data recorded') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>