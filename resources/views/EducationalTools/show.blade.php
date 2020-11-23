@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h3>{{ $educationalTool->name }}</h3>
        </div>
        <div class="col-2 text-right">
            <a href="/app/educational-tools/edit/{{ $educationalTool->id }}">Editar</a>
        </div>
    </div>
    <hr/>
    <div class="row mb-3">
        <div class="col">
            <h5>Cantidad</h5>
            <h6>{{ $educationalTool->qty }}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <h5>Institucion educativa</h5>
            <h6>{{ $educationalTool->educational_environment->educational_institution->name }}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <h5>Descripcion</h5>
            <h6>{{ $educationalTool->description }}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <h5>¿Esta habilitado?</h5>
            <h6>{{ $educationalTool->is_enabled?'Si':'No' }}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <h5>¿Esta disponible?</h5>
            <h6>{{ $educationalTool->is_available?'Si':'No' }}</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <h5>Ambiente</h5>
            <h6>{{ $educationalTool->educational_environment->name }}</h6>
        </div>
    </div>
</div>

@endsection
