@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Solicitud de prestamo del ambiente {{ $loan->educational_environment->name }}</h3>
    <hr />
    <div class="row">
        <div class="col">
            <label for="">Fechas</label>
            <p class="text-muted">{{ moment( $loan->start_date).format('LL') }} al {{ moment( $loan->end_date).format('LL') }}</p>
            <label for="">Proyecto</label>
            <p class="text-muted">{{ $loan->project->title }}</p>
            <label for="">Responsables</label>
            <p class="text-muted">
                    @forelse ($loan->project->authors as $author)
                    {{$author->name}}
                    @empty
                      No author
                    @endforelse
            </p>
            <label for="">Estudiante lider del semillero</label>
            <p class="text-muted">{{ $principal_research_team->student_leader === null ? 'No tiene estudiante lider' : $principal_research_team->student_leader->user->name }}</p>
            <label for="">Numero celular del estudiante lider del semillero</label>
            <p class="text-muted">{{ $principal_research_team->student_leader === null ? 'No tiene estudiante lider' : $principal_research_team->student_leader->user->cellphone_number }}</p>
            <label for="">Correo electronico del estudiante lider del semillero</label>
            <p class="text-muted">{{ $principal_research_team->student_leader === null ? 'No tiene estudiante lider' : $principal_research_team->student_leader->user->email }}</p>
            <label for="">Justificacion</label>
            <p class="text-muted">{this.state.loan.loan.justification}</p>
            <label for="">Carta de autorizarion</label>
            <br />
            <a download href="/storage/{{ $loan->authorization_letter }}" > {{ $loan->authorization_letter.split('/')[1] }} </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <form onSubmit={this.handleSubmit}>
                <div class="form-group">
                    <label for="">¿Acepta la solicitud?</label>
                    <br />
                    @if ($canAcepted)
                        <div>
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
                    @else
                         <p>Hay una solicitud aceptada y no se ha devuelto</p>
                    @endif

                </div>
                <div class="form-group">
                    <label for="">Comentario</label>
                    <textarea
                        name="annotation"
                        id="annotation"
                        cols="10"
                        class="form-control"
                    ></textarea>
                    <div class="invalid-feedback">

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
