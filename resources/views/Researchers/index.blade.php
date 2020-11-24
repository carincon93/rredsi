<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Researchers
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
                                <a href="/researchers/create" class="btn btn-primary">Crear</a>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Correo electrónico</th>
                                    <th scope="col">Institución educativa / Grupo de investigación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($researchers as $researcher)
                                        <tr>
                                            <td>{{ $researcher->user->name  }}</td>
                                            <td>{{ $researcher->user->email }}</td>
                                            <td></td>
                                            <td class="actions">
                                            <div class="actions-wrapper">
                                                <a href="/researchers/edit/{{ $researcher->id }}"> Editar </a>
                                                <a href="/researchers/detail/{{ $researcher->id }}"> Detail </a>
                                                <button class="btn" type="button" > Eliminar </button>
                                            </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                        <td colSpan="4">No researchers</td>
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

