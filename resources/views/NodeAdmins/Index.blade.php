@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">

                <div class="card-header">
                    <h2>Node Admins</h2>
                    <a href="/app/node-admins/create"> Crear administrador de nodo </a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Nodo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($nodeAdmins as $nodeAdmin)
                            <tr>
                                <td>{{ $nodeAdmin->user->name }}</td>
                                <td>{{ $nodeAdmin->user->document_type }} {{ $nodeAdmin->user->document_number }}</td>
                                <td>{{ $nodeAdmin->user->email }}</td>
                                <td>{{ $nodeAdmin->node?->state }}</td>

                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/node-admins/edit/${{ $nodeAdmin->user->id }}" >Editar </a>
                                        <a href="/app/node-admins/detail/${{ $nodeAdmin->user->id }}"> Detail </a>
                                        <button class="btn" type="button" > Eliminar </button>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colSpan="4">No Nodes Admin</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
