@extends('layouts.app')

@section('content')

<div className="container">
    <div className="form-wrapper">
        <form className="form" id="form" action="" method="" >
            <div className="form-group">
                <label for="name">name</label>
                <small id="nameHelp" className="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="text"
                    className="form-control"
                    name="name"
                    id="name"
                    defaultValue={{ $educationalEnvironment->name }}
                    maxLength=""
                    required
                />
                <span className="invalid-feedback">

                </span>
            </div>

            <div className="form-group">
                <label for="type">type</label>
                <small id="typeHelp" className="form-text text-muted">
                    Campo requerido
                </small>
                <select
                    name="type"
                    id="type"
                    className="form-control"
                    defaultValue={{ $educationalEnvironment->type }}
                >
                    <option value="">Seleccione uno</option>
                    <option value="salon">Salon</option>
                    <option value="laboratorio">Laboratorio</option>
                </select>

                <span className="invalid-feedback">

                </span>
            </div>

            <div className="form-group">
                <label for="description">
                    description
                </label>
                <small id="cellphone_numberHelp" className="form-text text-muted" >
                    Campo requerido
                </small>
                <textarea
                    name="description"
                    id="description"
                    defaultValue={{ $educationalEnvironment->description }}
                    className="form-control"
                ></textarea>

                <span className="invalid-feedback">

                </span>
            </div>

            <div className="form-group">
                <label for="capacity_aprox">capacity_aprox</label>
                <small id="capacity_aproxHelp" className="form-text text-muted" >
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="capacity_aprox"
                    id="capacity_aprox"
                    defaultValue={{ $educationalEnvironment->capacity_aprox }}
                    className="form-control"
                />
                <span className="invalid-feedback">

                </span>
            </div>

            <div className="form-group">
                <label for="document_number">¿Habilitado?</label>
                <small
                    id="document_numberHelp"
                    className="form-text text-muted"
                >
                    Campo requerido
                </small>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" type="radio" name="is_enabled" id="is_enable_yes" value="1"   defaultChecked={{ $isEnabledChecked == 1 ? true : false }} />
                    <label className="form-check-label" for="is_enable_yes">Si</label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" type="radio" name="is_enabled" id="is_enabled_no" value="0"  defaultChecked={{ $isEnabledChecked == 0 ? true : false }} />
                    <label className="form-check-label" for="is_enabled_no">No</label>
                </div>
                {{-- <span className={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                    {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''}
                </span> --}}
            </div>

            <div className="form-group">
                <label for="document_number">Disponible?</label>
                <small
                    id="document_numberHelp"
                    className="form-text text-muted"
                >
                    Campo requerido
                </small>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" type="radio" name="is_available" id="is_available_yes" value="1" defaultChecked={{ $isAvailableChecked == 1 ? true : false }} />
                    <label className="form-check-label" for="is_available_yes">Si</label>
                </div>
                <div className="form-check form-check-inline">
                    <input className="form-check-input" type="radio" name="is_available" id="is_available_no" value="0" defaultChecked={{ $isAvailableChecked == 0 ? true : false }} />
                    <label className="form-check-label" for="is_available_no">No</label>
                </div>
                {{-- <span className={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                    {rules.is_available.message ? rules.is_available.message : requestValidation.is_available ? requestValidation.is_available : ''}
                </span> --}}
            </div>

            <div className="form-group">
                <label for="educational_institution_id">Institucion educativa</label>
                <small id="document_numberHelp" className="form-text text-muted" > Campo requerido </small>
                <educational_institution_id name="educational_institution_id" id="educational_institution_id" className="form-control" defaultValue={{ $educationalEnvironment->educational_institution_id }}>

                    @forelse ($educationalInstitutions as $educationalInstitution)
                    <option value={{$educationalInstitution->id}}>  {{$educationalInstitution->name}} </option>
                    @empty
                        <option value="">No educational institutions</option>
                    @endforelse

                </select>
            </div>

            <button className="btn btn-primary" type="submit"  form="form" > Guardar </button>

        </form>
    </div>
</div>

@endsection
