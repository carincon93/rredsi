@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" id="form"
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
                    defaultValue={{ $educationalInstitutionAdmin->user->name }}
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
                <small id="emailHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    id="email"
                    defaultValue={{ $educationalInstitutionAdmin->user->email }}
                    aria-describedby="emailHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="cellphone_number">
                    cellphone_number
                </label>
                <small
                    id="cellphone_numberHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="cellphone_number"
                    class="form-control"
                    id="cellphone_number"
                    defaultValue={{ $educationalInstitutionAdmin->user->cellphone_number }}
                    aria-describedby="cellphone_numberHelp"
                    min="0"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.cellphone_number.message ? rules.cellphone_number.message : requestValidation.cellphone_number ? requestValidation.cellphone_number : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="document_type">document_type</label>
                <small
                    id="document_typeHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <select
                    id="document_type"
                    name="document_type"
                    class="form-control"
                    maxLength=""
                    required
                    defaultValue={{ $educationalInstitutionAdmin->user->document_type }}
                >
                    <option value=''>
                        Seleccione el tipo de documento
                    </option>
                    <option value="CC">Cédula de ciudadanía</option>
                    <option value="CE">Cédula de extranjería</option>
                    <option value="TI">Tarjeta de identidad</option>
                </select>
                <span class="invalid-feedback">
                    {{-- {rules.document_type.message ? rules.document_type.message : requestValidation.document_type ? requestValidation.document_type : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="document_number">document_number</label>
                <small
                    id="document_numberHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="document_number"
                    class="form-control"
                    id="document_number"
                    defaultValue={{ $educationalInstitutionAdmin->user->document_number }}
                    aria-describedby="document_numberHelp"
                    min="0"
                    max=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.document_number.message ? rules.document_number.message : requestValidation.document_number ? requestValidation.document_number : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="interests">Intereses</label>
                <small id="interestsHelp" class="form-text text-muted">Campo requerido</small>
                <textarea
                    name="interests"
                    class="form-control"
                    id="interests"
                    rows="3"
                    defaultValue={{ $interests }}
                >
                </textarea>
                <span class="invalid-feedback">
                    {{-- {rules.interests.message ? rules.interests.message : requestValidation.interests ? requestValidation.interests : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <small id="statusHelp" class="form-text text-muted">Campo requerido</small>
                <select id="status"
                    name="status"
                    class="form-control"
                    required
                    defaultValue={{ $educationalInstitutionAdmin->user->status }}
                >
                    <option value=''>Seleccione el estado</option>
                    <option value="Aceptado">Aceptado</option>
                    <option value="En espera">En espera</option>
                    <option value="Rechazado">Rechazado</option>
                </select>
                <span class="invalid-feedback">
                    {{-- {rules.status.message ? rules.status.message : requestValidation.status ? requestValidation.status : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label>¿Habilitado?</label>
                <p class="text-muted">Campo requerido</p>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="is_enabled" id="is_enabled_yes" value="1" defaultChecked={{ $isEnabledChecked == 1 ? true : false }} />
                    <label class="custom-control-label" for="is_enabled_yes">Si</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="is_enabled" id="is_enabled_no" value="0"  defaultChecked={{ $isEnabledChecked == 0 ? true : false }} />
                    <label class="custom-control-label" for="is_enabled_no">No</label>
                </div>
            </div>
            <div class="form-group">
                <label for="role_id">Rol</label>
                <p class="text-muted">Campo requerido</p>
                <input
                    type="hidden"
                    name="role_id"
                    value="3"
                />
                <input
                    type="text"
                    class="form-control"
                    disabled
                    value="Administrador de semillero"
                />
                <span class="invalid-feedback">
                    {{-- {rules.role_id.message ? rules.role_id.message : requestValidation.role_id ? requestValidation.role_id : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="node_id">Nodo</label>
                <small
                    id="document_typeHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <select
                    id="node_id"
                    name="node_id"
                    class="form-control"
                    required
                    defaultValue={{ $educationalInstitutionAdmin->node_id }}
                >
                    <option value="1">
                        Caldas
                    </option>

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
