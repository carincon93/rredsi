@extends('layouts.app')

@section('content')

<div class="container">

    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Educational Tools</h2>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/app/educational-tools/create" class="btn btn-primary">Crear</a>
                        <a href="/app/educational-tools/loan-request" class="btn btn-secondary">Solicitudes de prestamos</a>
                        <a href="/app/educational-tools/loan-returns" class="btn btn-secondary">Devoluciones de equipos</a>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Institucion educativa</th>
                            <th>Ambiente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($educationalTools as $educationalTool)
                            <tr>
                                <td>{{ $educationalTool->name }}</td>
                                <td>{{ $educationalTool->educational_environment->educational_institution->name }}</td>
                                <td>{{ $educationalTool->educational_environment->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">

                                        {{-- {this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned)?(
                                            <a to='#' data-id={this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned).id} onClick={this.handleReturn}>
                                                Devolver prestamo
                                            </a>
                                        ):(
                                            <a to={`/app/educational-tools/request/${educationalTool.id}`}>
                                                Solicitar prestamo
                                            </a>
                                        )} --}}

                                        <a href="/app/educational-tools/edit/{{ $educationalTool->id }}">
                                            Editar
                                        </a>
                                        <a href="/app/educational-tools/detail/{{ $educationalTool->id }}">
                                            Detalle
                                        </a>
                                        <button
                                            class="btn"
                                            type="button"
                                            data-id={educationalTool.id}
                                            onClick={this.handleDelete}
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <tr>
                                <td colSpan="4" class="text-center"> No hay datos disponibles </td>
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
