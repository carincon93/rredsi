@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Research team admins</h2>
                    <a href="/app/research-team-admins/create" class="btn btn-primary">Crear</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Celular</th>
                            <th>Institución educativa</th>
                            <th>Semillero</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($researchTeamAdmins as $researchTeamAdmin)

                            <tr>
                                <td>{{ $researchTeamAdmin->user->name }}</td>
                                <td>{{ $researchTeamAdmin->user->email }}</td>
                                <td>{{ $researchTeamAdmin->user->cellphone_number }}</td>
                                <td>{{ $researchTeamAdmin->educational_institution->name }}</td>
                                <td>{{ $researchTeamAdmin->is_research_team_admin->name }}</td>
                                <td class="actions">
                                    <div class="actions-wrapper">
                                        <a href="/app/research-team-admins/edit/${{ $researchTeamAdmin->id }}"> Editar </a>
                                        <a href="/app/research-team-admins/detail/${{ $researchTeamAdmin->id }}"> Detalle </a>

                                    <button
                                        class="btn"
                                        type="button"
                                        data-id={{ $researchTeamAdmin->id }}
                                        disabled={{ $researchTeamAdmin->is_research_team_admin?true:false }}
                                    >
                                        Eliminar
                                    </button>

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colSpan="6">No research team admins</td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
