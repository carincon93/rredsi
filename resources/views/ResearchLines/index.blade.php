<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Líneas de investigación
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
                                    <a href="{{ route('nodes.educational-institutions.research-groups.research-lines.create', [$node, $educationalInstitution, $researchGroup]) }}" >Crear línea de investigación</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Línea de investigación</th>
                                            <th scope="col">Grupo de ínvestigación</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($researchLines as $researchLine)
                                            <tr>
                                                <td>{{ $researchLine->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-lines.show', [$node, $educationalInstitution, $researchGroup, $researchLine]) }}">
                                                            Show
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-lines.edit', [$node, $educationalInstitution, $researchGroup, $researchLine]) }}">
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.research-lines.destroy', [$node, $educationalInstitution, $researchGroup, $researchLine]) }}">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="4">No research lines data</td>
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


