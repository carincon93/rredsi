<title>{{"Editar la información del producto de investigación $researchOutput->title"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Research outputs') }}
                <span class="text-base sm:text-lg block text-purple-300">
                    <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project]) }}" class="text-white font-weight underline">Crear producto de investigación</a> / Editar producto de investigación
                </span>
            </h2>
        </div>
        {{-- @can('index_research_output')
        <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project]) }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                {{ __('Back')}}
            </div>
        </a>
        @endcan --}}
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-4">
            <div class="md:col-span-1">
                <x-jet-section-title>
                    <x-slot name="title">Descripción</x-slot>
                    <x-slot name="description">Editar la información del producto de investigación</x-slot>
                </x-jet-section-title>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.research-outputs.update', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam, $project, $researchOutput]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-jet-label class="mb-4" for="title" value="{{ __('Title') }}" />
                        <x-jet-input id="title" class="block mt-1 w-full" type="text" min="" max="" name="title" value="{{ old('title') ?? $researchOutput->title }}" required />
                        <x-jet-input-error for="title" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="description" value="{{ __('Description') }}" />
                        <textarea rows="20" id="description" name="description" class="form-textarea border-0 w-full" value="{{ old('description') ?? $researchOutput->description }}" required >{{ old('description') ?? $researchOutput->description }}</textarea>
                        <x-jet-input-error for="description" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <x-jet-label class="mb-4" for="typology" value="{{ __('Minciencias typology') }}" />
                        <select id="typology" name="typology" class="form-select w-full" required >
                            <option value="">Seleccione una sub-tipología Minciencias</option>
                            @foreach ($mincienciasTypologies as $mincienciasTypology)
                                <option value="{{ $mincienciasTypology['name'] }}"  {{ old('typology') == $mincienciasTypology['name'] || $researchOutput->typology == $mincienciasTypology['name'] ? "selected" : "" }}>{{ $mincienciasTypology['name'] }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="typology" class="mt-2" />
                    </div>

                    <div class="mt-1/6">
                        <p class="mb-4">Archivo</p>
                        <p class="mb-4">A continuación, puede cargar un archivo (.pdf) (Opcional)</p>
                        <div class="mx-auto cursor-pointer w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150" id="yourBtn" onclick="getFile()">
                            Clic para subir el archivo
                        </div>
                        <input class="hidden" id="file" type="file" onchange="sub(this)" accept="application/pdf" name="file" value="{{ old('file') ?? $researchOutput->file }}" />
                        <x-jet-input-error for="file" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Edit') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function getFile() {
                document.getElementById('file').click();
            }

            function sub(obj) {
                var file = obj.value;
                var fileName = file.split('\\');
                document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
                document.myForm.submit();
                event.preventDefault();
            }
        </script>
    @endpush

    {{--Alert component --}}
    @if (session('status') || !is_null($errors) && $errors->any() > 0)
        <x-data-alert />
    @endif

</x-app-layout>
