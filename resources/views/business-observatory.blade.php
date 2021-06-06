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
                <div class="block m-5 object-center">
                <form method="POST" action="{{ route('result-observatory') }}">
                @csrf
                @method('POST')
                    <div class="inline-block m-4">
                        <input class="appearance-none block bg-gray-100 text-gray-700 border border-blue-900 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" minlength="3" maxlength="50" id="txt-search" name="txt-search"type="text" pattern="[a-zA-Z0-9 ]{3,50}" title="Ingrese texto a buscar" placeholder="Texto a buscar" required>
                    </div>
                    <div class="inline-block m-4">
                        <button class="text-center bg-transparent hover:bg-blue-900 text-blue-800 font-semibold hover:text-white py-2 px-4 border border-blue-900 hover:border-transparent rounded">
                        Filtrar
                        </button>
                    </div>
                    </form>
                </div>
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
                            <div class="max-w-xs bg-gray-50 shadow-lg rounded-lg overflow-hidden m-5 block ">
                                <div class="px-4 py-2 h-35">
                                    <h1 class="h-15 text-justify block text-gray-900 font-bold text-lg mt-3">{{ substr($project->title, 0 ,50) }}@if(count_chars($project->title) > 50)...@endif</h1>
                                    <p class="h-15 text-justify block text-gray-600 text-base mt-3">{{ substr($project->abstract, 0 ,250) }}@if(count_chars($project->abstract) > 250)...@endif</p>
                                </div>
                                <img class="h-56 w-full object-cover mt-2" src="https://picsum.photos/200/300" alt="">
                                @php
                                    $researchTeam = $project->researchTeams()->where('is_principal', 1)->first() ?? null;
                                @endphp
                                <div class="flex items-center justify-between px-4 py-2 bg-blue-900">
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
                    <!-- muentra un mensaje en caso de que no haya proyectos vigentes -->
                    @if($projects == [] || $bandera == 0)
                                <div></div>
                                <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3 object-center m-8" role="alert">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                                    <p>No hay proyectos para visualizar.</p>
                                </div>
                            
                        @endif
                </div>
                <!-- Links de paginación -->
                <div class="block m-5 object-center grid">
                    {{ $projects->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
