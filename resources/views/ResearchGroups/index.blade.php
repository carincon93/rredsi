<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Grupos de investigación
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div className="container">
                    <div className="flex-row">
                        <div className="flex-large">
                            <div className="card">
                                <div className="card-header">
                                    <a  href="{{ route('nodes.educational-institutions.research-groups.create', [$node, $educationalInstitution]) }}" >Crear grupo de investigación</a>
                                </div>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Institución educativa</th>
                                            <th scope="col">GrupLac</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($researchGroups as $researchGroup)
                                            <tr>
                                                <td>{{ $researchGroup->name }}</td>
                                                <td>{{ $researchGroup->educationalInstitution->name }}</td>
                                                <td>{{ $researchGroup->gruplac }} </td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.show', [$node, $educationalInstitution, $researchGroup]) }}" >
                                                            Show
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.edit', [$node, $educationalInstitution, $researchGroup]) }}" >
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.research-groups.edit', [$node, $educationalInstitution, $researchGroup]) }}" >
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

