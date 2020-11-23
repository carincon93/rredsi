<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Programas de formación
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
                                    <a href="/academic-programs/create">Crear programa de formación</a>
                                </div>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Código</th>
                                            <th scope="col">Institución educativa</th>
                                            <th scope="col">Nivel académico</th>
                                            <th scope="col">Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($academicPrograms as $academicProgram)
                                                <td>{{ $academicProgram->name }}</td>
                                                <td>{{ $academicProgram->code }}</td>
                                                <td>{{ $academicProgram->educationalInstitution->name }}</td>
                                                <td>{{ $academicProgram->academic_level }}</td>


                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/app/academic-programs/edit/{{ $academicProgram->id }}"> Editar </a>
                                                        <a href="/app/academic-programs/detail/{{ $academicProgram->id }}"> Detail </a>
                                                        <button class="btn btn-danger" type="button" >Eliminar </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="4">No Academic Programs</td>
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



