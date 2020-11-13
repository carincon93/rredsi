@extends('layouts.app')

@section('content')

<div class="container">
    <p>Crear solicitud</p>
    <div class="row">
        <div class="col-8 mx-auto">
            <form action="" method="" id="form">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col">
                            <label for="">Fecha inicio</label>
                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                class="form-control"
                            />
                            <div class="invalid-feedback">
                                {{-- {rules.start_date.message ? rules.start_date.message : requestValidation.start_date ? requestValidation.start_date : ''} --}}
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Fecha fin</label>
                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                class="form-control"
                            />
                            <div class="invalid-feedback">
                                {{-- {rules.end_date.message ? rules.end_date.message : requestValidation.end_date ? requestValidation.end_date : ''} --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Proyecto</label>
                    <select
                        name="project_id"
                        id="project_id"
                        class="form-control"
                    >
                        <option value="">Seleccione uno</option>
                        @forelse ($projects as $project)
                             <option value={{ $project->id }} >{{ $project->title }}</option>
                        @empty
                            <option value="">No projects</option>
                        @endforelse

                    </select>
                    <div class="invalid-feedback">
                        {{-- {rules.project_id.message ? rules.project_id.message : requestValidation.project_id ? requestValidation.project_id : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Justificacion</label>
                    <textarea
                        name="justification"
                        id="justification"
                        class="form-control"
                    ></textarea>
                    <div class="invalid-feedback">
                        {{-- {rules.justification.message ? rules.justification.message : requestValidation.justification ? requestValidation.justification : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Carta de autorizacion</label>
                    <input
                        type="file"
                        name="authorization_letter"
                        id="authorization_letter"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{-- {rules.authorization_letter.message ? rules.authorization_letter.message : requestValidation.authorization_letter ? requestValidation.authorization_letter : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Equipo / Herramienta</label>
                    <select
                        name="educational_tool_id"
                        id="educational_tool_id"
                        class="form-control"
                        defaultValue={{ $tool->id }}
                        readOnly
                    >
                        <option value="">Seleccione uno</option>
                        @forelse ($tools as $tool)
                             <option value={{ $tool->id }}> {{ $tool->name }}</option>
                        @empty
                            <option value="">No tools</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">
                        {{-- {rules.educational_tool_id.message ? rules.educational_tool_id.message : requestValidation.educational_tool_id ? requestValidation.educational_tool_id : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
