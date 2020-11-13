@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form"
        >
            <div class="form-group">
                <label for="name">name</label>
                <small id="nameHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    defaultValue={{ $educationalInstitution->name }}
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="nit">nit</label>
                <small id="nitHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="nit"
                    class="form-control"
                    id="nit"
                    aria-describedby="nitHelp"
                    defaultValue={{ $educationalInstitution->nit }}
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.nit.message ? rules.nit.message : requestValidation.nit ? requestValidation.nit : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="address">address</label>
                <small id="addressHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="address"
                    class="form-control"
                    id="address"
                    aria-describedby="addressHelp"
                    defaultValue={{ $educationalInstitution->address }}
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.address.message ? rules.address.message : requestValidation.address ? requestValidation.address : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="phone_number">phone_number</label>
                <small id="phone_numberHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="phone_number"
                    class="form-control"
                    id="phone_number"
                    aria-describedby="phone_numberHelp"
                    defaultValue={{ $educationalInstitution->phone_number }}
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.phone_number.message ? rules.phone_number.message : requestValidation.phone_number ? requestValidation.phone_number : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="website">website</label>
                <small id="websiteHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    name="website"
                    class=form-control
                    id="website"
                    defaultValue=""
                    aria-describedby="websiteHelp"
                    defaultValue={{ $educationalInstitution->website }}
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.website.message ? rules.website.message : requestValidation.website ? requestValidation.website : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="administrator_id">Seleccione un administrador de institucion educativa</label>
                <small id="administrator_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="administrator_id"
                    name="administrator_id"
                    class="form-control"
                    aria-describedby="administrator_idHelp"
                    required
                >
                    <option value='none'>Seleccione una institución educativa</option>

                        @forelse ($educationalInstitutionAdmins as $educationalInstitutionAdmin)
                            <option value={{ $educationalInstitutionAdmin->user->id }} > {{ $educationalInstitutionAdmin->user->name }} </option>
                        @empty
                             <option value="">No educational institutions admins</option>
                        @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''} --}}

                </span>
            </div>

            <div class="form-group">
                <label for="node_id">Nodo</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="node_id"
                    name="node_id"
                    class="form-control"
                    defaultValue=""
                    aria-describedby="node_idHelp"
                    required
                >
                    <option value=''>Seleccione una institución educativa</option>
                        @forelse ($educationalInstitutionAdmins as $educationalInstitutionAdmin)
                            <option value={{ $educationalInstitutionAdmin->node->id }} >
                                 {{ $educationalInstitutionAdmin->node->state }}
                             </option>
                        @empty
                             <option value="">No educational institutions</option>
                        @endforelse

                </select>
                <span class="invalid-feedback">
                    {{-- {rules.node_id.message ? rules.node_id.message : requestValidation.node_id ? requestValidation.node_id : ''} --}}
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
