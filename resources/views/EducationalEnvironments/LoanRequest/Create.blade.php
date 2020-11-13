@extends('layouts.app')

@section('content')

<div class="container">
    <p>Crear solicitud</p>
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="" method="" id="form" >
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha inicio</label>
                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                class="form-control"
                            />
                            <span class="invalid-feedback">

                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha fin</label>
                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                class="form-control"
                            />
                            <span class="invalid-feedback">

                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Proyecto</label>
                            <select
                                name="project_id"
                                id="project_id"
                                class="form-control"
                            >
                                <option value="">Seleccione uno</option>

                                @forelse ($projects as $project)
                                     <option value={{$project->id}}>  {{$project->title}} </option>
                                @empty
                                    <option value="">No projects</option>
                                @endforelse

                            </select>
                            <span class="invalid-feedback">

                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Justificacion</label>
                            <textarea
                                name="justification"
                                id="justification"
                                class="form-control"
                            ></textarea>
                            <span class="invalid-feedback">

                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Carta de autorizacion</label>
                            <input
                                type="file"
                                name="authorization_letter"
                                id="authorization_letter"
                                class="form-control"
                            />
                            <span class="invalid-feedback">

                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Ambiente</label>
                            <select
                                name="educational_environment_id"
                                id="educational_environment_id"
                                class="form-control"
                                defaultValue={{ $educationalEnvironment->id }}
                                readOnly
                            >
                                <option value="">Seleccione uno</option>

                                @forelse ($educationalEnvironments as $educationalEnvironment)
                                    <option value={{$educationalEnvironment->id}}>  {{$educationalEnvironment->name}} </option>
                                @empty
                                     <option value="">No educational environment</option>
                                @endforelse

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
