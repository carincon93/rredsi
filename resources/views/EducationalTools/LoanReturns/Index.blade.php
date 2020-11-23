@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Educational Tools Loan Returns</h2>
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
                        @forelse ($loans as $loan)

                            <tr>
                                <td>{{ $loan->educational_tool->name }}</td>
                                <td>{{ $loan->educational_tool->educational_environment->educational_institution->name }}</td>
                                <td>{{ $loan->educational_tool->educational_environment->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/educational-tools/return-check/{{ $loan->id }}" >
                                            Revisar devolucion
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colSpan="4" class="text-center">No hay datos disponibles</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
