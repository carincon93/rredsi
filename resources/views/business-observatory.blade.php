<!-- Layout exclusivo para el usuario tipo empresa -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Observatorio') }}
            <span class="sm:block text-purple-300">
            </span>
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="mt-8 text-2xl">
                    Proyectos públicos
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="ml-20 bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <!-- Crea una card por cada uno de los projectos activos y -->
                    @foreach ($projects as $project)
                        @if(!$project->is_privated)
                            <div class="max-w-xs bg-gray-50 shadow-lg rounded-lg overflow-hidden my-10 ">
                                <div class="px-4 py-2">
                                    <h1 class="text-gray-900 font-bold text-lg mt-3"><?php echo($project->title)?></h1>
                                    <p class="text-gray-600 text-base mt-3">{{ substr($project->abstract, 0 ,250) }}@if(count_chars($project->abstract) > 250)...@endif</p>
                                </div>
                                <img class="h-56 w-full object-cover mt-2" src="https://picsum.photos/200/300" alt="">
                                @php
                                    $researchTeam = $project->researchTeams()->where('is_principal', 1)->first() ?? null;
                                @endphp
                                <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                                    @if($researchTeam)
                                    <h1 class="text-gray-300 font-bold">{{ optional($researchTeam->researchGroup)->educationalInstitutionFaculty->educationalInstitution->name }}</h1>
                                    @else
                                    <h1 class="text-gray-300 font-bold">No disponible</h1>
                                    @endif
                                    <a href="{{ route('observatories.show', [$project]) }}" class="px-3 py-1 bg-gray-200 text-sm text-gray-900 font-semibold rounded ">Explorar</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- Links de paginación -->
                <div class="px-4 py-2 mx-auto">
                    <?php echo $projects->links(); ?>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
