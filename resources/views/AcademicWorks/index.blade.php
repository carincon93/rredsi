<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Obra académica
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
                                    <a href="/academic-works/create">Crear obra académica</a>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Área de conocimiento</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Autores</th>
                                            <th scope="col">Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($academicWorks as $academicWork)
                                                <td>{{ $academicWork->title }}</td>
                                                <td>{{ $academicWork->knowledge_area_id }}</td>
                                                <td>{{ $academicWork->type}}</td>
                                                <td>{{ $academicWork->authors }}</td>


                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/academic-works/edit/{{ $academicWork->id }}"> Editar </a>
                                                        <a href="/academic-works/detail/{{ $academicWork->id }}"> Detail </a>
                                                        <button class="btn btn-danger" type="button" >Eliminar </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="4">No academic works</td>
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



