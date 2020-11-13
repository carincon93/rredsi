@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-wrapper">
        <form class="form" action="" id="form" method="POST" >
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
                <label for="code">code</label>
                <small id="nameHelp" class="form-text text-muted">
                    Campo requerido
                </small>
                <input
                    type="number"
                    name="code"
                    class="form-control"
                    id="code"
                    defaultValue=""
                    aria-describedby="nameHelp"
                    maxLength={rules.code.max}
                    required
                />
                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <label for="academic_level">Nivel Acádemico</label>
                <small id="academic_levelHelp" class="form-text text-muted">Campo requerido</small>
                <select id="academic_level" name="academic_level" class="" required >
                    <option value=''>Seleccione el estado</option>
                    <option value="Técnico Profesional">Técnico Profesional</option>
                    <option value="Técnologo">Técnologo</option>
                    <option value="Profesional">Profesional</option>
                    <option value="Especialización Técnica Profesional">Especialización Técnica Profesional</option>
                    <option value="Especialización Técnologica">Especialización Técnologica</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <label for="start_date">Fecha de Inicio</label>
                        <small id="start_datelHelp" class="form-text text-muted">Campo requerido</small>
                        <input
                            type="date"
                            name="start_date"
                            class="form-control"
                            id="start_date"
                            defaultValue=""
                            aria-describedby="nameHelp"
                            maxLength={rules.start_date.max}
                            required
                        />
                        <span class="invalid-feedback">

                        </span>
                    </div>
                    <div class="col">
                        <label for="end_date">Fecha Final</label>
                        <small id="start_datelHelp" class="form-text text-muted">Campo requerido</small>
                        <input
                            type="date"
                            name="end_date"
                            class="form-control"
                            id="end_date"
                            defaultValue=""
                            aria-describedby="nameHelp"
                            maxLength={rules.end_date.max}
                            required
                        />
                        <span class="invalid-feedback">

                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="modality">Nivel Acádemico</label>
                <small id="modalityHelp" class="form-text text-muted">Campo requerido</small>
                <select id="modality"
                    name="modality"
                    class="form-control"
                >
                    <option value=''>Seleccione el estado</option>
                    <option value="Presencial">Presencial</option>
                    <option value="A distancia">A distancia</option>
                </select>
                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <label for="daytime">Jornada</label>
                <small id="daytimeHelp" class="form-text text-muted">Campo requerido</small>
                <select id="daytime" name="daytime" class="" required  >
                    <option value=''>Seleccione el estado</option>
                    <option value="Diurna">Diurna</option>
                    <option value="Mixta">Mixta</option>
                    <option value="Nocturna">Nocturna</option>
                </select>
                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <label for="knowledge_area_id">Area De Conocimiento</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="knowledge_area_id"
                    name="knowledge_area_id"
                    class="form-control"
                    defaultValue=""
                    aria-describedby="node_idHelp"
                    required >
                    <option value=''>Seleccione un area de conocimiento</option>

                            @forelse ($knowledgeAreas as $knowledgeArea)
                                <option value={{$knowledgeArea->id}}>  {{$knowledgeArea->name}} </option>
                            @empty
                                <option value="">No knowledge areas</option>
                            @endforelse

                </select>

                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <label for="node_id">Nodo</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="node_id"
                    name="node_id"
                    class="form-control"
                    defaultValue=""
                    aria-describedby="node_idHelp"
                    required
                >
                    <option value=''>Seleccione un Nodo</option>

                        @forelse ($nodes as $node)
                            <option value={{$node->id}}>  {{$node->state}} </option>
                        @empty
                            <option value="">No Nodes</option>
                        @endforelse

                </select>
                <span class="invalid-feedback">

                </span>
            </div>
            <div class="form-group">
                <label for="educational_institution_id">Institución educativa</label>
                <small id="node_idHelp" class="form-text text-muted">Campo requerido</small>
                <select
                    id="educational_institution_id"
                    name="educational_institution_id"
                    class="form-control"
                    defaultValue=""
                    aria-describedby="node_idHelp"
                    required
                >
                    <option value=''>Seleccione una institución educativa</option>

                        @forelse ($educationalInstitutions as $educationalInstitution)
                            <option value={{$educationalInstitution->id}}>  {{$educationalInstitution->name}} </option>
                        @empty
                            <option value="">No educational institutions</option>
                        @endforelse

                </select>
                <span class="invalid-feedback">

                </span>
            </div>

            <button class="btn btn-primary" type="submit" form="form" > Guardar </button>
        </form>
    </div>
</div>
@endsection
