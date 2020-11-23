<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear obra académica
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                        <form  action={{ route('academic-works.store')}}  method="POST" >
                            @csrf

                            <div class="form-group">
                                <label for="title">Titulo: </label>
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    id="title"
                                    defaultValue=""
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo: </label>
                                <input
                                    type="text"
                                    name="type"
                                    class="form-control"
                                    id="type"
                                    defaultValue=""
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="authors">Autores: </label>
                                <input
                                    type="text"
                                    name="authors"
                                    class="form-control"
                                    id="authors"
                                    defaultValue=""
                                    aria-describedby="authorsHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="grade">Grado: </label>
                                <input
                                    type="text"
                                    name="grade"
                                    class="form-control"
                                    id="grade"
                                    defaultValue=""
                                    aria-describedby="gradeHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>

                            <div class="form-group">
                                <label for="mentors">Mentores: </label>
                                <input
                                    type="text"
                                    name="mentors"
                                    class="form-control"
                                    id="mentors"
                                    defaultValue=""
                                    aria-describedby="mentorsHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>


                            <div class="form-group">
                                <label for="knowledge_area_id">Área de conocimiento: </label>
                                {{-- <small id="node_idHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <select
                                    id="knowledge_area_id"
                                    name="knowledge_area_id"
                                    class="form-control"
                                    defaultValue=""
                                    aria-describedby="node_idHelp"
                                    required >
                                    <option value=''>Seleccione un área de conocimiento</option>

                                            @forelse ($knowledgeAreas as $knowledgeArea)
                                                <option value={{$knowledgeArea->id}}>  {{$knowledgeArea->name}} </option>
                                            @empty
                                                <option value="">No knowledge areas</option>
                                            @endforelse

                                </select>

                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="graduation_id">Graduaciones: </label>
                                {{-- <small id="graduationsHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <select
                                    id="graduation_id"
                                    name="graduation_id"
                                    class="form-control"
                                    defaultValue=""
                                    aria-describedby="graduation_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione</option>

                                        @forelse ($graduations as $graduation)
                                            <option value={{$graduation->id}}>  {{$graduation->state}} </option>
                                        @empty
                                            <option value="">No graduation</option>
                                        @endforelse

                                </select>
                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="research_group_id">Grupo de investigación: </label>
                                {{-- <small id="graduationsHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <select
                                    id="research_group_id"
                                    name="research_group_id"
                                    class="form-control"
                                    defaultValue=""
                                    aria-describedby="research_group_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione un grupo de investigación</option>

                                        @forelse ($researchGroups as $researchGroup)
                                            <option value={{$researchGroup->id}}>  {{$researchGroup->name}} </option>
                                        @empty
                                            <option value="">No research group</option>
                                        @endforelse

                                </select>
                                <span class="invalid-feedback">

                                </span>
                            </div>

                            <button type="submit" > Guardar </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>

</x-app-layout>
