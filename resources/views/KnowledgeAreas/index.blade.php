<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Areas de Conocimiento
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
                                    <a href="/knowledge-areas/create" >Crear Área de Conocimiento </a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Código</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($knowledgeAreas as $knowledgeArea)
                                            <tr>
                                                <td>{{ $knowledgeArea->name }}</td>
                                                <td>{{ $knowledgeArea->id }}<td>

                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/knowledge-areas/edit/{{ $knowledgeArea->id }}" >
                                                            Editar
                                                        </a>

                                                        <a href="/knowledge-areas/detail/{{ $knowledgeArea->id }}" >
                                                            Detail
                                                        </a>

                                                        <button
                                                            class="btn"
                                                            type="button"
                                                        >
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colSpan="4">No knowledge Area</td>
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
