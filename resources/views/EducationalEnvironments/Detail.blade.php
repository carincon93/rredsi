@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
        <div class="card-header">
            <h4>{{ $educationalEnvironment->name }}</h4>
            <a href="/app/educational-institution-admins/edit/{{ $educationalEnvironment->id }}"> Editar </a>
        </div>
        <hr />
        <ul class="list-unstyled">
            <li class="media">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Tipo</h5>
                    {{ $educationalEnvironment->type }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Descripcion</h5>
                    {{ $educationalEnvironment->description }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Capacidad aproximada</h5>
                    {{ $educationalEnvironment->capacity_aprox }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Esta habilitado?</h5>
                    {{ $educationalEnvironment->is_enabled?'Si':'No' }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Esta disponible?</h5>
                    {{ $educationalEnvironment->is_available?'Si':'No' }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Institución educativa</h5>
                    {{ $educationalEnvironment->educational_institution->name }}
                </div>
            </li>
        </ul>
    </div>
</div>


@endsection
