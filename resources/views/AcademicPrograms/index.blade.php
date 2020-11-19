@extends('layouts.app')

@section('content')

<div class="container">
    <div class="flex-row">
        <div class="flex-large">
            <div class="card">
                <div class="card-header">
                    <h2>Programas de Formación</h2>
                    <a href="/app/academic-programs/create">Crear Programa de Formación</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Código</th>
                            <th scope="col">Institución Educativa</th>
                            <th scope="col">Nivel Acádemico</th>
                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($academicPrograms as $academicProgram)
                                <td>{{ $academicProgram->name }}</td>
                                <td>{{ $academicProgram->code }}</td>
                                <td>{{ $academicProgram->educational_institution->name }}</td>
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

@endsection
