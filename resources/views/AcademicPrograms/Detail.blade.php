@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-4 detail">
        <div class="card-header">
            <h4>{{ $academicProgram->name }}</h4>
            <a href="/app/academic-programs/edit/{{ $academicProgram->id }}" > Editar </a>
        </div>
        <hr />
        <ul class="list-unstyled">
            <li class="media">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Código</h5>
                    {{ $academicProgram->code }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Nivel de Formacion</h5>
                    {{ $academicProgram->academic_level }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Modalidad</h5>
                    {{ $academicProgram->modality }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Jornada</h5>
                    {{ $academicProgram->daytime }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Institución Educativa</h5>
                    {{ $academicProgram->educational_institution_id }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Fechas</h5>
                    {{ $academicProgram->start_date }} al {{ $academicProgram->end_date }}
                </div>
            </li>
            <li class="media my-4">
                <img class="mr-3" src="" alt="circle" />
                <div class="media-body">
                    <h5 class="mt-0 mb-1">Facultad</h5>
                    facu
                </div>
            </li>
        </ul>
    </div>
</div>


@endsection
