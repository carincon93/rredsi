<!-- Layout exclusivo para el usuario tipo empresa -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Dashboard') }}
            <span class="sm:block text-purple-300">
            </span>
        </h2>
    </x-slot>
    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Componente welcome para la vista de empresa -->
                <x-welcome-company />
                <div class="block">
                    <div class="ml-20 bg-white bg-opacity-25 grid grid-cols-1 md:grid-cols-3 block">
                        <!-- Crea una card por cada uno de los projectos activos y -->
                        @php
                            $bandera=0;
                        @endphp
                        @foreach ($projects as $project)
                            @if(!$project->is_privated)
                            @php
                                $bandera +=1;
                            @endphp
                                <div class="max-w-xs bg-gray-50 shadow-lg rounded-lg overflow-hidden m-5">
                                    <div class="px-4 h-35">
                                        <h1 class="h-15 text-justify block text-gray-900 font-bold text-lg mt-3">{{ substr($project->title, 0 ,50) }}@if(count_chars($project->title) > 50)...@endif</h1>
                                        <p class="h-15 text-justify block text-gray-600 text-basemt-3">{{ substr($project->abstract, 0 ,75) }}@if(count_chars($project->abstract) > 75)...@endif</p>
                                    </div>
                                    <img class="h-56 w-full object-cover mt-2" src="https://picsum.photos/200/300" alt="">
                                    @php
                                        $researchTeam = $project->researchTeams()->where('is_principal', 1)->first() ?? null;
                                    @endphp
                                    <div class="flex items-center justify-between px-2 py-2 bg-blue-900">
                                        @if($researchTeam)
                                        <h1 class="text-gray-300 font-bold">{{ optional($researchTeam->researchGroup)->educationalInstitutionFaculty->educationalInstitution->name }}</h1>
                                        @else
                                        <h1 class="text-gray-300 font-bold">No disponible</h1>
                                        @endif
                                        <a href="{{ route('observatories.show', [$project]) }}" class="px-2 py-1 bg-gray-200 text-sm text-blue-900 font-semibold rounded">Ver mas</a>
                                    </div>
                                </div>
                            @endif
                            <!-- determina el número de cards que se muestran -->
                            @break($loop->iteration == 6)
                        @endforeach
                        <!-- muentra un mensaje en caso de que no haya proyectos vigentes -->
                        @if($projects == [] || $bandera == 0)
                                <div></div>
                                <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 object-center m-8" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p>No hay proyectos para visualizar.</p>
                                </div>
                            
                        @endif
                    </div>
                </div>
                <div class="block m-5 object-center grid">
                <a href="{{ route('business-observatory') }}" class="text-center bg-transparent hover:bg-blue-900 text-blue-800 font-semibold hover:text-white py-2 px-4 border border-blue-900 hover:border-transparent rounded">
                Ver más proyectos
                </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
