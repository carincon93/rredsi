<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Equipos de investigación
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
                                    <a href="/research-teams/create" class="btn btn-primary">Crear equipo de investigación</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Areas de conocimiento</th>
                                            <th>Tematicas de investigacion</th>
                                            <th>Institución educativa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($researchTeams as $researchTeam)
                                            <tr>
                                                <td>{{ $researchTeam->name }}</td>
                                                <td>
                                                    @forelse ($researchTeam->knowledge_areas as $area)
                                                        {{" " + $area->name}}
                                                    @empty
                                                        {{""}}
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse ($researchTeam->thematic_research as $thematic)
                                                        {{$thematic}}
                                                    @empty

                                                    @endforelse
                                                </td>
                                                <td>{{ $researchTeam->research_group->educational_institution->name }}</td>

                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/research-teams/edit/{{ $researchTeam->id }}"> Editar </a>
                                                        <a href="/research-teams/detail/{{ $researchTeam->id}}"> Detalle </a>
                                                        <button class="btn btn-danger" type="button" data-id={{ $researchTeam->id }} >Eliminar </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colSpan="6">No research teams</td>
                                            </tr>

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="modal" tabIndex="-1" role="dialog">
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
                    </div>  --}}


                </div>
            </div>

        </div>

    </div>


</x-app-layout>