@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form" >

            <div class="form-group">
                <label for="name">name</label>
                <small id="nameHelp" class="form-text text-muted">Campo requerido</small>
                <input type="text"
                    name="name"
                    class="form-control"
                    id="name"
                    aria-describedby="nameHelp"
                    maxLength=""
                    autoFocus
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <small id="emailHelp" class="form-text text-muted">Campo requerido</small>
                <input type="email"
                    name="email"
                    class="form-control"
                    id="email"
                    aria-describedby="emailHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="cellphone_number">cellphone_number</label>
                <small id="cellphone_numberHelp" class="form-text text-muted">Campo requerido</small>
                <input type="number"
                    name="cellphone_number"
                    class="form-control"
                    id="cellphone_number"
                    aria-describedby="cellphone_numberHelp"
                    min="0"
                    max=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.cellphone_number.message ? rules.cellphone_number.message : requestValidation.cellphone_number ? requestValidation.cellphone_number : ''} --}}
                </span>
            </div>
            <div class="form-group">
                <label for="document_type">document_type</label>
                <small id="document_typeHelp" class="form-text text-muted">Campo requerido</small>
                <select id="document_type"
                    name="document_type"
                    class="form-control"
                    required
                >
                    <option value=''>Seleccione el tipo de documento</option>
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
                <small id="document_numberHelp" class="form-text text-muted">Campo requerido</small>
                <input type="number"
                    name="document_number"
                    class="form-control"
                    id="document_number"
                    aria-describedby="document_numberHelp"
                    min="0"
                    max=""
                    required
                />
                <span class="invalid-feedback">
                    {{-- {rules.document_number.message ? rules.document_number.message : requestValidation.document_number ? requestValidation.document_number : ''} --}}
                </span>
            </div>



            {/* faltan los campos de interes */}






            <div>
                <label>is_enabled</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="is_enabled_yes" name="is_enabled" class="custom-control-input" value="1" />
                    <label class="custom-control-label" for="is_enabled_yes">Si</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="is_enabled_no" name="is_enabled" class="custom-control-input"  value="0" />
                    <label class="custom-control-label" for="is_enabled_no">No</label>
                </div>

                <span class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                    {{-- {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''} --}}
                </span>
            </div>

            <div class="form-group">
                <label for="status">status</label>
                <small id="statusHelp" class="form-text text-muted">Campo requerido</small>
                <select id="status"
                    name="status"
                    class="form-control"
                    required
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
                <label for="node_id">node</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <input type="hidden"
                    name="node_id"
                    class="form-control"
                    id="node_id"
                    aria-describedby="node_idHelp"
                    min="0"
                    defaultValue="1"
                    max=""
                    required
                />
                <input type="text"
                    name="node"
                    class='form-control'
                    id="node"
                    aria-describedby="node_idHelp"
                    min="0"
                    defaultValue="Caldas"
                    required
                    readOnly
                />
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
