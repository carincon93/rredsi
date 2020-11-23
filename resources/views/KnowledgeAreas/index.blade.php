@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Areas de Conocimiento</h2>
                    <a href="/app/knowledge-areas/create" >Crear Área de Conocimiento </a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Código</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($knowledgeAreas as $knowledgeArea)
                            <tr>
                                <td>{{ $knowledgeArea->name }}</td>
                                <td>{{ $knowledgeArea->id }}<td>

                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/knowledge-areas/edit/{{ $knowledgeArea->id }}" >
                                            Editar
                                        </a>

                                        <a href="/app/knowledge-areas/detail/{{ $knowledgeArea->id }}" >
                                            Detail
                                        </a>

                                        <button
                                            class="btn"
                                            type="button"
                                        >
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colSpan="4">No knowledge Area</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
