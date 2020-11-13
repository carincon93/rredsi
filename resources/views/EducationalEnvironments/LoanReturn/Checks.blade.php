@extends('layouts.app')

@section('content')

<div class="container">
    <p>Revisar devolucion de ambiente</p>
    <div class="row">
        <div class="col-8 mx-auto">
            <form action="" method="" id="form">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha inicio</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" defaultValue={{ $loan->start_date }} readOnly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha fin</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" defaultValue={{ $loan->end_date }} readOnly />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha de devolucion</label>
                            <input type="datetime" name="returned_at" id="returned_at" class="form-control" defaultValue={{ $loan->returned_at }} readOnly />
                        </div>
                    </div>
                </div>
                <div class="form-row mb-2">
                    <div class="col">
                        <label for="">¿Devolucion aceptada?</label>
                        <br />
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="is_accepted"
                                id="inlineRadio1"
                                value="1"
                            />
                            <label class="form-check-label" for="inlineRadio1">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="is_accepted"
                                id="inlineRadio2"
                                value="0"
                            />
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                        {{-- <span class={rules.is_accepted.isInvalid && rules.is_accepted.message !== '' || requestValidation.is_accepted ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                            {rules.is_accepted.message ? rules.is_accepted.message : requestValidation.is_accepted ? requestValidation.is_accepted : ''}
                        </span> --}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Comentario</label>
                            <textarea
                                name="annotation"
                                id="annotation"
                                class="form-control"
                                required
                            ></textarea>
                            <span class="invalid-feedback">
                                {{-- {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''} --}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Ambiente</label>
                            <select name="ambient_id" id="ambient_id" class="form-control" readOnly>
                                @forelse ($educationalEnvironments as $educationalEnvironment)

                                    <option value={{ $educationalEnvironment->id }}
                                    defaultChecked={{ $educationalEnvironment->id === $loan->educational_environment_id ? 'checked' : ''}}
                                    >

                                     {{ $educationalEnvironment->name }} </option>

                                @empty
                                    <option value="">No ambients</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Proyecto</label>
                            <select name="project_id" id="project_id" class="form-control" readOnly defaultValue={{ $loan->project_id }}>

                                @forelse ($projects as $project)
                                    <option value={{ $project->id }} >{{ $project->title }}</option>
                                @empty
                                     <option value="">No projects</option>
                                @endforelse

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
