@extends('layouts.app')

@section('content')

<div class="container">
    <p>Editar equipo / herramienta</p>
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="" method="" id="form">
            <div class="form-group">
                    <label for="">Nombre</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        defaultValue={{ $educationalTool->name }}
                    />
                    <div class="invalid-feedback">
                        {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Descripcion</label>
                    <textarea
                        name="description"
                        id="description"
                        class="form-control"
                        defaultValue={{ $educationalTool->description }}
                    ></textarea>
                    <div class="invalid-feedback">
                        {{-- {rules.description.message ? rules.description.message : requestValidation.description ? requestValidation.description : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input
                        type="number"
                        name="qty" id="qty"
                        class="form-control"
                        defaultValue={{ $educationalTool->qty }}
                    />
                    <div class="invalid-feedback">
                        {{-- {rules.qty.message ? rules.qty.message : requestValidation.qty ? requestValidation.qty : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">¿Habilitado?</label>
                    <br />
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="is_enabled"
                            id="inlineRadio1"
                            value="1"
                            defaultChecked={{ $educationalTool->is_enabled?true:false }}
                        />
                        <label class="form-check-label" for="inlineRadio1">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="is_enabled"
                            id="inlineRadio2"
                            value="0"
                            defaultChecked={{ $educationalTool->is_enabled?true:false }}
                        />
                        <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                    {{-- <div class={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'}>
                        {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''}
                    </div> --}}
                </div>
                <div class="form-group">
                    <label for="">¿Disponible?</label>
                    <br />
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="is_available"
                            id="inlineRadio3"
                            value="1"
                            defaultChecked={{ $educationalTool->is_available?true:false }}
                        />
                        <label class="form-check-label" for="inlineRadio3">Si</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="is_available"
                            id="inlineRadio4"
                            value="0"
                            defaultChecked={{ $educationalTool->is_available?true:false }}
                        />
                        <label class="form-check-label" for="inlineRadio4">No</label>
                    </div>
                    {{-- <div class={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block': 'invalid-feedback'}>
                        {rules.is_available.message ? rules.is_available.message : requestValidation.is_available ? requestValidation.is_available : ''}
                    </div> --}}
                </div>
                <div class="form-group">
                    <label for="">Institucion educativa</label>
                    <select
                        name="educational_institution_id"
                        id="educational_institution_id"
                        class="form-control"
                        defaultValue={{ $educationalTool->educational_environment->educational_institution_id }}
                    >
                        <option value="">Seleccione uno</option>

                        @forelse ($educationalInstitutions as $educationalInstitution)
                             <option value={{ $educationalInstitution->id }}> {{ $educationalInstitution->name }} </option>
                        @empty
                            <option value="">No educational institutions</option>
                        @endforelse


                    </select>
                    <div class="invalid-feedback">
                        {{-- {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Ambiente</label>
                    <select
                        name="educational_environment_id"
                        id="educational_environment_id"
                        class="form-control"
                        defaultValue={{ $educationalTool->educational_environment_id }}
                    >
                        <option value="">Seleccion uno</option>

                        @forelse ($educationalEnvironments as $educationalEnvironment)
                             <option value={{ $educationalEnvironment->id }} > {{ $educationalEnvironment->name }} </option>
                        @empty
                             <option value="">No educational environments</option>
                        @endforelse

                    </select>
                    <div class="invalid-feedback">
                        {{-- {rules.educational_environment_id.message ? rules.educational_environment_id.message : requestValidation.educational_environment_id ? requestValidation.educational_environment_id : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
