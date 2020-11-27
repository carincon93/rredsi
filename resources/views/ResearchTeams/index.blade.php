<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Research teams
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">
                <div class="container">
                    <div class="flex-row">
                        <div class="flex-large">
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.create', [$node, $educationalInstitution, $researchGroup]) }}" class="btn btn-primary">Crear semillero de investigación</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Institución educativa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($researchTeams as $researchTeam)
                                            <tr>
                                                <td>{{ $researchTeam->name }}</td>
                                                <td>{{ $researchTeam->researchGroup->educationalInstitution->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.show', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">Show</a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.edit', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">Edit</a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.destroy', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">Delete</a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">Manage projects</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="6">No research teams data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
