@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Lineas de Investigación</h2>
                    <a href="/app/research-lines/create" >Crear Linea de Investigación</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Linea de Investigación</th>
                            <th scope="col">Grupo de Investigación</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($researchLines as $researchLine)
                            <tr>
                                <td>{{ $researchLine->name }}</td>
                                <td>{{ $researchLine->research_group?->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/research-lines/edit/${{ $researchLine->id }}">
                                            Editar
                                        </a>
                                        <a href="/app/research-lines/detail/${{ $researchLine->id }}">
                                            Detail
                                        </a>
                                        <button class="btn" type="button" >
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colSpan="4">No Research Lines</td>
                            </tr>
                        @endforelse




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
