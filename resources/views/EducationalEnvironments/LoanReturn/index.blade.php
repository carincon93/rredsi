@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Educational Environments Loan Returns</h2>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/app/educational-environments/create" class="btn btn-primary">Crear</a>
                        <a href="/app/educational-environments/loan-request" class="btn btn-secondary">Solicitudes de prestamos</a>
                        <a href="/app/educational-environments/loan-returns" class="btn btn-secondary">Devoluciones de ambientes</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Institucion educativa</th>
                            <th>Tipo de ambiente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($educationalEnvironmentsWithLoans as $loan)
                            <tr>
                                <td>{{ $loan->educational_environment->educational_institution->name }}</td>
                                <td>{{ $loan->educational_environment->type }}</td>
                                <td>{{ $loan->educational_environment->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        @if ( $loan->returned_at && $loan->is_returned )
                                             <p>Devuelto</p>
                                        @else
                                            <a href="/app/educational-environments/return-check/{{ $loan->id }}"> Revisar devolucion </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colSpan="6">{{ __('No data recorded') }}</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" tabIndex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Estas seguro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>No podras revertir esto.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDelete">Si, eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
