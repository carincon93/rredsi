@extends('layouts.app')

@section('content')

<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" method="" id="form" >
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
                    defaultValue=""
                    aria-describedby="nameHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">

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
                    aria-describedby="emailHelp"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">

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
                    aria-describedby="cellphone_numberHelp"
                    min="0"
                    maxLength=""
                    required
                />
                <span class="invalid-feedback">

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
                >
                    <option value=''>
                        Seleccione el tipo de documento
                    </option>
                    <option value="CC">Cédula de ciudadanía</option>
                    <option value="CE">Cédula de extranjería</option>
                    <option value="TI">Tarjeta de identidad</option>
                </select>
                <span class="invalid-feedback">

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
                    aria-describedby="document_numberHelp"
                    min="0"
                    max=""
                    required
                />
                <span class="invalid-feedback">

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
                >
                </textarea>
                <span class="invalid-feedback">

                </span>
            </div>


            <div class="form-group">
                <label for="status">Estado</label>
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

                </span>
            </div>
            <div>
                <label>¿Habilitado?</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="is_enabled_yes" name="is_enabled" class="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="1" />
                    <label class="custom-control-label" for="is_enabled_yes">Si</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="is_enabled_no" name="is_enabled" class="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="0" />
                    <label class="custom-control-label" for="is_enabled_no">No</label>
                </div>

                {{-- <span class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'} >
                    {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : '' }
                </span> --}}
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
                    value="3"
                />
                <span class="invalid-feedback">

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
                >
                    <option value="1">
                        Caldas
                    </option>

                </select>
                <span class="invalid-feedback">

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
