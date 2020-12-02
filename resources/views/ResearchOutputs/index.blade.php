<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Research outputs
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
                                    <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.research-outputs.create', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}" class="btn btn-primary">Crear semillero de investigación</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Institución educativa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($researchOutputs as $researchOutput)
                                            <tr>
                                                <td>{{ $researchOutput->title }}</td>
                                                <td>{{ $researchOutput->researchTeam->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.show', [$node, $educationalInstitution, $researchGroup, $researchTeam, $researchOutput]) }}"> Show </a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.edit', [$node, $educationalInstitution, $researchGroup, $researchTeam, $researchOutput]) }}"> Edit </a>
                                                        <a class="modal-open" onclick="modal(' {{route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.destroy', [$node, $educationalInstitution, $researchGroup, $researchTeam, $researchOutput]) }}')"> Delete </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="6">No research outputs data</td>
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

    {{-- #Component modal --}}
    <x-dialog-modal>

    </x-dialog-modal>


</x-app-layout>
