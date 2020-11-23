<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Educational institutions
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
                                    <a href="/educational-institutions/create" > Crear institución educativa </a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Institución Educativa</th>
                                            <th scope="col">Municipio / Departamento</th>
                                            <th scope="col">Administrador</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($educationalInstitutions as $educationalInstitution)

                                            <tr>
                                                <td>{{ $educationalInstitution->name }}</td>
                                                <td>{{ $educationalInstitution->city }}</td>
                                                <td>{{ $educationalInstitution->administrator->user->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/app/educational-institutions/edit/{{ $educationalInstitution->id }}" >
                                                            Editar
                                                        </a>
                                                        <a href="/app/educational-institutions/detail/{{ $educationalInstitution->id }}" >
                                                            Detail
                                                        </a>
                                                        <button
                                                            class="btn btn-danger"
                                                            type="button"
                                                        >
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colSpan="4">No Educational Institutions</td>
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
