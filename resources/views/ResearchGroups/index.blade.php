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
                                    <a  href="/research-groups/create" >Crear grupo de investigación</a>
                                </div>
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Ubicación</th>
                                            <th scope="col">Institución Educativa</th>
                                            <th scope="col">GrupLac</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($researchGroups as $researchGroup)

                                            <tr>
                                                <td>{{ $researchGroup->name }}</td>
                                                <td>{{ $researchGroup->educational_institution->address }}</td>
                                                <td>{{ $researchGroup->educational_institution->name }}</td>
                                                <td>{{ $researchGroup->gruplac }} </td>
                                                <td className="actions">
                                                    <div className="actions-wrapper">
                                                        <a href="/research-groups/edit/{{ $researchGroup->id }}" >
                                                            Editar
                                                        </a>
                                                        <a href="/research-groups/detail/{{ $researchGroup->id }}" >
                                                            Detail
                                                        </a>
                                                        <button  className="btn btn-danger" type="button">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colSpan="4">No Research Lines</td>
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

