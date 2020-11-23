@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Educational Institution Admin</h2>
                    <a href="/app/educational-institution-admins/create" >
                        Crear administrador de institución educativa
                    </a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Institución Educativa</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($educationalInstitutionAdmins as $educationalInstitutionAdmin)

                            <tr>
                                <td>{{ $educationalInstitutionAdmin->user->name }}</td>
                                <td>{{ $educationalInstitutionAdmin->user->email }}</td>
                                <td>{{ $educationalInstitutionAdmin->user->cellphone_number }}</td>
                                <td>{{ $educationalInstitutionAdmin->educational_institution?->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a
                                            href="/app/educational-institution-admins/edit/{{ $educationalInstitutionAdmin->id }}"
                                        >
                                            Editar
                                        </a>
                                        <a
                                            href="/app/educational-institution-admins/detail/{{ $educationalInstitutionAdmin->id }}"
                                        >
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
                                <td colSpan="4">No Educational Institution Admins</td>
                            </tr>

                        @endforelse





                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
