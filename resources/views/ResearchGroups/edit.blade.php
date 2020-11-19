@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form" >
            <div class="form-group">
                <label for="name">name</label>
                <small id="nameHelp" class="form-text text-muted"> Campo requerido </small>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="name"
                    defaultValue={{ $researchGroup->name }}
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
                <small id="emailhelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="email"
                    defaultValue={{ $researchGroup->email }}
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
                <small id="leaderHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="leader"
                    class="form-control"
                    id="leader"
                    defaultValue={{ $researchGroup->leader }}
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
                <small id="gruplacHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="url"
                    name="gruplac"
                    class="form-control"
                    id="gruplac"
                    defaultValue={{ $researchGroup->gruplac }}
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
                <small id="minciencias_codeHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="minciencias_code"
                    class="form-control"
                    id="minciencias_code"
                    defaultValue={{ $researchGroup->minciencias_code }}
                    aria-describedby="minciencias_codeHelp"
                    maxLength=""
                    required


                />
                <span class="invalid-feedback">
                    {{-- {rules.minciencias_code.message ? rules.minciencias_code.message : requestValidation.minciencias_code ? requestValidation.minciencias_code : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="minciencias_category">Caterigoria de minciencias</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="minciencias_category"
                    name="minciencias_category"
                    class="form-control"
                    defaultValue={{ $researchGroup->minciencias_category }}
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
                <small id="websiteHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="url"
                    name="website"
                    class="form-control"
                    id="website"
                    defaultValue={{ $researchGroup->website }}
                    aria-describedby="websiteHelp"
                    maxLength=""
                    required


                />
                <span class="invalid-feedback">
                    {{-- {rules.website.message ? rules.website.message : requestValidation.website ? requestValidation.website : ''} --}}
                </span>
            </div>

            <button
                class="btn btn-primary"
                type="submit"
                form="form"
            >
                Guardar
            </button>
        </form>
    </div>
</div>

@endsection
