@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
        <div class="card-header">
            <h4>{{ $researchLine->name }}</h4>
            <a href="/app/research-groups/edit/{{ $researchLine->id }}"> Editar </a>
        </div>
        <hr />
        <ul class="list-unstyled">
            <li class="media">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Objetivos</h5>
                    {{ $researchLine->objectives }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Misión</h5>
                    {{ $researchLine->mission }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Visión</h5>
                    {{ $researchLine->vision }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Logros</h5>
                    {{ $researchLine->achievements }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Áreas de Conocimiento </h5>
                    {{ $researchLine->minciencias_category }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Grupo de investigacion</h5>
                    {{ $researchLine->website }}
                </div>
            </li>
        </ul>
    </div>
</div>

@endsection
