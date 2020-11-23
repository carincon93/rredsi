@extends('layouts.app')

@section('content')

<div className="container">
    <div className="flex-row">
        <div className="flex-large">
            <div className="card">
                <div className="card-header">
                    <h2>Grupos de Investigación</h2>
                    <a  href="/app/research-groups/create" >Crear Grupo de investigación</a>
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
                                <td>{{ $researchGroup?->name }}</td>
                                <td>{{ $researchGroup->educational_institution?->address }}</td>
                                <td>{{ $researchGroup->educational_institution?->name }}</td>
                                <td>{{ $researchGroup->gruplac }} </td>
                                <td className="actions">
                                    <div className="actions-wrapper">
                                        <a href="/app/research-groups/edit/{{ $researchGroup->id }}" >
                                            Editar
                                        </a>
                                        <a href="/app/research-groups/detail/{{ $researchGroup->id }}" >
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

@endsection
