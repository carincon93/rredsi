<x-guest-layout>

    <x-guest-header :node="$node" image="images/AdobeStock_Student.jpeg">
        <x-slot name="title">
            <h1 class="text-4xl sm:text-5xl tracking-tight font-extrabold leading-none">
                <span class="block text-blue-900 xl:inline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 20 20" class="inline mb-2">
                        <path regular" d="M14.03,12.914l-5.82,2.66a1.288,1.288,0,0,0-.636.636l-2.66,5.82A.8.8,0,0,0,5.97,23.086l5.82-2.66a1.288,1.288,0,0,0,.636-.636l2.66-5.82a.8.8,0,0,0-1.056-1.056Zm-3.119,6a1.288,1.288,0,1,1,0-1.821A1.288,1.288,0,0,1,10.91,18.91ZM10,8A10,10,0,1,0,20,18,10,10,0,0,0,10,8Zm0,18.065A8.065,8.065,0,1,1,18.065,18,8.074,8.074,0,0,1,10,26.065Z" transform="translate(0 -8)" fill="#233876" />
                    </svg> 
                    Explorer: Conecte con jóvenes investigadores
                </span>
            </h1>
        </x-slot>
        <x-slot name="textBase">
            Fortalezca los resultados de su proyecto conectando con jóvenes investigadores de otras áreas de conocimiento y de instituciones educativas cómo:
            @foreach ($node->educationalInstitutions->shuffle()->take(10) as $educationalInstitution)
                {{ $educationalInstitution->name }},
            @endforeach
        </x-slot>
        <x-slot name="actionButton">
            <a href="#test" class="w-full flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-900 hover:bg-blue-800 md:text-lg md:px-10">
                {{ __('Get started') }}
            </a>
        </x-slot>
    </x-guest-header>

    <div class="py-12" id="test">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="p-6 mt-4">
                <h1 class="text-center text-2xl text-center mb-12">A continuación se muestran los programas de formación de las {{ $node->educationalInstitutions->count() }} instituciones educativas adscritas a RREDSI Nodo {{ $node->state }}. Selecciona un programa de formación y conecta con estudiantes o profesionales.</h1>
                @forelse ($node->academicPrograms->chunk(3) as $chunk)
                    <div class="flex items-center justify-between mb-4">
                        @foreach ($chunk as $academicProgram)
                            <div>
                                <a href="{{ route('nodes.explorer.searchRoles', [$node, $academicProgram]) }}">
                                    <span class="underline">{{ $academicProgram->name }}</span>
                                    <p class="text-gray-400"><small>{{ $academicProgram->educationalInstitutionFacultyName }}</small></p>
                                    <p class="text-gray-400"><small>{{ $academicProgram->educationalInstitutionName }}</small></p>
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