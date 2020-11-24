@extends('layouts.app')

@section('content')

<div class="containe">
    <p>Revision de devolucion</p>
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
                                defaultValue={{ $loan->start_date }}
                                readOnly
                            />
                        </div>
                        <div class="col">
                            <label for="">Fecha fin</label>
                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                class="form-control"
                                defaultValue={{ $loan->end_date }}
                                readOnly
                            />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Fecha devolucion</label>
                    <input
                        type="datetime"
                        name="returned_at"
                        id="returned_at"
                        class="form-control"
                        defaultValue={{ $loan->returned_at }}
                        readOnly
                    />
                </div>
                <div class="form-group">
                    <label for="">¿Devolucion aceptada?</label>
                    <br/>
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
                </div>
                <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea
                        name="annotation"
                        id="annotation"
                        class="form-control"
                    >
                    </textarea>
                    <div class="invalid-feedback">
                        {{-- {rules.annotation.message ? rules.annotation.message : requestValidation.annotation ? requestValidation.annotation : ''} --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Equipo</label>
                    <select
                        name="educational_tool_id"
                        id="educational_tool_id"
                        class="form-control"
                        defaultValue={{ $loan->educational_tool_id }}
                        readOnly
                    >
                        <option value="">Seleccione uno</option>

                        @forelse ($tools as $tool)
                             <option value={{ $tool->id }} > {{ $tool->name }} </option>
                        @empty
                             <option value="">No tools</option>
                        @endforelse


                    </select>
                </div>
                <div class="form-group">
                    <label for="">Proyecto</label>
                    <select
                        name="project_id"
                        id="project_id"
                        class="form-control"
                        defaultValue={{ $loan->project_id }}
                        readOnly
                    >
                        <option value="">Seleccione uno</option>

                        @forelse ($projects as $project)
                            <option value={{ $project->id }} >{{ $project->title }} </option>
                        @empty
                            <option value="">No projects</option>
                        @endforelse

                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
