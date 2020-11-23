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
                    class="form-control"
                    name="name"
                    id="name"
                    maxlength=""
                    required
                />
                <span class="invalid-feedback">
                </span>
            </div>

            <div class="form-group">
                <label for="type">type</label>
                <small id="typeHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <select
                    name="type"
                    id="type"
                    class="form-control"
                >
                    <option value="">Seleccione uno</option>
                    <option value="salon">Salon</option>
                    <option value="laboratorio">Laboratorio</option>
                </select>

                <span class="invalid-feedback">

                </span>
            </div>

            <div class="form-group">
                <label for="description">
                    description
                </label>
                <small
                    id="cellphone_numberHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <textarea
                    name="description"
                    id="description"
                    class="form-control"
                ></textarea>

                <span class="invalid-feedback">

                </span>
            </div>

            <div class="form-group">
                <label for="capacity_aprox">capacity_aprox</label>
                <small id="capacity_aproxHelp"  class="form-text text-muted" >
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="capacity_aprox"
                    id="capacity_aprox"
                    class="form-control"
                />
                <span class="invalid-feedback">

                </span>
            </div>

            <div class="form-group">
                <label for="document_number">¿Habilitado?</label>
                <small
                    id="document_numberHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_enabled" id="is_enable_yes" value="1" />
                    <label class="form-check-label" for="is_enable_yes">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_enabled" id="is_enabled_no" value="0" />
                    <label class="form-check-label" for="is_enabled_no">No</label>
                </div>
                {{-- <span class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block' : 'invalid-feedback'} >

                </span> --}}
            </div>

            <div class="form-group">
                <label for="document_number">Disponible?</label>
                <small id="document_numberHelp"  class="form-text text-muted" >
                    Campo requerido
                </small>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_available" id="is_available_yes" value="1" />
                    <label class="form-check-label" for="is_available_yes">Si</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_available" id="is_available_no" value="0" />
                    <label class="form-check-label" for="is_available_no">No</label>
                </div>
                {{-- <span class={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block' : 'invalid-feedback'} >

                </span> --}}
            </div>

            <div class="form-group">
                <label for="educational_institution_id">Institucion educativa</label>
                <small
                    id="document_numberHelp"
                    class="form-text text-muted"
                >
                    Campo requerido
                </small>
                <select name="educational_institution_id" id="educational_institution_id" class="form-control">

                    @forelse ($educationalInstitutions as $educationalInstitution)
                        <option value={{$educationalInstitution->id}}>  {{$educationalInstitution->name}} </option>
                    @empty
                        <option value="">No educational institutions</option>
                    @endforelse

                </select>
            </div>

            <button  class="btn btn-primary" type="submit" form="form" > Guardar </button>
        </form>
    </div>
</div>

@endsection
