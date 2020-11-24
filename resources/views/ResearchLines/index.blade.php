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
                                    <a href="/research-lines/create" >Crear Linea de Investigación</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Línea de Investigación</th>
                                            <th scope="col">Grupo de Investigación</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($researchLines as $researchLine)
                                            <tr>
                                                <td>{{ $researchLine->name }}</td>
                                                <td>{{ $researchLine->research_group->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/research-lines/edit/${{ $researchLine->id }}">
                                                            Editar
                                                        </a>
                                                        <a href="/research-lines/detail/${{ $researchLine->id }}">
                                                            Detail
                                                        </a>
                                                        <button class="btn" type="button" >
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


