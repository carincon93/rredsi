<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear grupo de investigación
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                        <form action={{ route('research-groups.store') }} method="POST" >
                            @csrf

                            <div class="form-group">
                                <label for="name">name</label>
                                {{-- <small id="nameHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    defaultValue=""
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email">email</label>
                                {{-- <small id="emailhelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    id="email"
                                    defaultValue=""
                                    aria-describedby="emailHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="leader">leader</label>
                                {{-- <small id="leaderHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="text"
                                    name="leader"
                                    class="form-control"
                                    id="leader"
                                    defaultValue=""
                                    aria-describedby="leaderHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.leader.message ? rules.leader.message : requestValidation.leader ? requestValidation.leader : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="gruplac">gruplac</label>
                                {{-- <small id="gruplacHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="url"
                                    name="gruplac"
                                    class="form-control"
                                    id="gruplac"
                                    defaultValue=""
                                    aria-describedby="gruplacHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.gruplac.message ? rules.gruplac.message : requestValidation.gruplac ? requestValidation.gruplac : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="minciencias_code">minciencias_code</label>
                                {{-- <small id="minciencias_codeHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="text"
                                    name="minciencias_code"
                                    class="form-control"
                                    id="minciencias_code"
                                    defaultValue=""
                                    aria-describedby="minciencias_codeHelp"
                                    maxLength=""
                                    required


                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.minciencias_code.message ? rules.minciencias_code.message : requestValidation.minciencias_code ? requestValidation.minciencias_code : ''} --}}
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="minciencias_category">Nodo</label>
                                {{-- <small id="node_idHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <select
                                    id="minciencias_category"
                                    name="minciencias_category"
                                    class="form-control"
                                    defaultValue=""
                                    aria-describedby="node_idHelp"
                                    required
                                >
                                    <option value=''>Seleccione una categoria</option>

                                    <option value="A" key="A">A</option>
                                    <option value="B" key="B">B</option>

                                </select>
                                <span class="invalid-feedback">
                                    {{-- {rules.minciencias_category.message ? rules.minciencias_category.message : requestValidation.minciencias_category ? requestValidation.minciencias_category : ''} --}}

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="website">website</label>
                                {{-- <small id="websiteHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="url"
                                    name="website"
                                    class="form-control"
                                    id="website"
                                    defaultValue=""
                                    aria-describedby="websiteHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.website.message ? rules.website.message : requestValidation.website ? requestValidation.website : ''} --}}
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="educational_institution_id"> Institución educativa :</label>
                                <small id="educational_institution_id" class="form-text text-muted">Campo requerido</small>
                                <select id="educational_institution_id"
                                    name="educational_institution_id"
                                    class="form-control"
                                    required
                                >
                                    <option value=''>Selecciones un institución </option>

                                    @forelse ($educationalInstitutions as $educationalInstitution)
                                        <option value={{ $educationalInstitution->id }}>{{ $educationalInstitution->name }}</option>
                                    @empty
                                        <option value="">No educational Institution</option>
                                    @endforelse

                                </select>
                                <span class="invalid-feedback">
                                    {{-- {rules.educationalInstitution.message ? rules.educationalInstitution.message : requestValidation.educationalInstitution ? requestValidation.educationalInstitution : ''} --}}
                                </span>
                            </div>
                            <button type="submit"> Guardar </button>
                        </form>
                    </div>
                </div>


            </div>

        </div>


    </div>


</x-app-layout>
