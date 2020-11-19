@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Nodes</h2>
                    <a href="/app/nodes/create" >Crear Nodo</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nodo</th>
                            <th scope="col">Administrador</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($nodes as $node)
                            <tr>
                                <td>{{ $node->state }}</td>
                                <td>{{ $node->administrator?->user?->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/nodes/edit/{{ $node->id }}" > Editar </a>
                                        <a href="/app/nodes/detail/{{ $node->id }}" > Detail </a>
                                        <button class="btn" type="button" > Eliminar </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colSpan="4">No Nodes</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
