@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Solicitud de prestamo del equipo {{ $educational_tool->name }}</h3>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Fechas</h5>
            <h6>{{ moment($loan->start_date).format('LL') }} al {{ moment($loan->end_date).format('LL') }} </h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Proyecto</h5>
            <h6>{{ $loan->project->title }}</h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Resposables</h5>
            <h6>
                @forelse ($loan->project->authors as $author)
                    {{ $author->name}}
                @empty
                    No author
                @endforelse
            </h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Estudiante lider</h5>
            <h6>
                @forelse ($loan->project->research_teams as $team)
                        @if ($team->pivot->is_principal && $team->student_leader_id)
                            {{ $team->student_leader->name }}
                        @else
                            No tiene estudiante lider
                        @endif
                @empty
                    No Teams
                @endforelse
            </h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Numero celular de estudiante lider</h5>
            <h6>
                @forelse ($loan->project->research_teams as $team)
                    @if ($team->pivot->is_principal && $team->student_leader_id)
                        {{ $team->student_leader->cellphone_number }}
                    @else
                        No tiene estudiante lider
                    @endif
                @empty
                    No Teams
                @endforelse
            </h6>

        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Correo electronico de estudiante lider</h5>
            <h6>
                @forelse ($loan->project->research_teams as $team)
                @if ($team->pivot->is_principal && $team->student_leader_id)
                    {{ $team->student_leader->email }}
                @else
                    No tiene estudiante lider
                @endif
                @empty
                    No Teams
                @endforelse
            </h6>

        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Justificacion</h5>
            <h6>{{ $loan->justification }}</h6>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h5>Carta de autorizacion</h5>
            <a download href="/storage/{{ $loan->authorization_letter }}">{{ $loan->authorization_letter.split('/')[1]}} </a>
        </div>
    </div>
    <form action="" method="" id="form">
        <div class="row mt-4">
            <div class="col">
                <h5>¿Acepta la solicitud?</h5>

                @if ( $canAccepted )
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="is_accepted"
                            id="inlineRadio1" value="1"
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

                @else
                    <p>Hay una solicitud aceptada y no ha sido devuelta</p>
                @endif

            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <h5>Comentario</h5>
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
        </div>
        <div class="row mt-4">
            <div class="col">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>


@endsection
