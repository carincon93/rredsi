<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Educational tools
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
                                    <h2></h2>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('nodes.educational-institutions.educational-environments.educational-tools.create', [$node, $educationalInstitution, $educationalEnvironment]) }}" class="btn btn-primary">Crear</a>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Institucion educativa</th>
                                            <th>Ambiente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($educationalTools as $educationalTool)
                                            <tr>
                                                <td>{{ $educationalTool->name }}</td>
                                                <td>{{ $educationalTool->educationalEnvironment->educationalInstitution->name }}</td>
                                                <td>{{ $educationalTool->educationalEnvironment->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">

                                                        {{-- {this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned)?(
                                                            <a to='#' data-id={this.state.loans.find(loan => loan.educational_tool_id === educationalTool.id && !loan.loan.is_returned).id} onClick={this.handleReturn}>
                                                                Devolver prestamo
                                                            </a>
                                                        ):(
                                                            <a to={`/app/educational-tools/request/${educationalTool.id}`}>
                                                                Solicitar prestamo
                                                            </a>
                                                        )} --}}

                                                        <a href="{{ route('nodes.educational-institutions.educational-environments.educational-tools.show', [$node, $educationalInstitution, $educationalEnvironment, $educationalTool]) }}">
                                                            Show
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.educational-environments.educational-tools.edit', [$node, $educationalInstitution, $educationalEnvironment, $educationalTool]) }}">
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('nodes.educational-institutions.educational-environments.educational-tools.destroy', [$node, $educationalInstitution, $educationalEnvironment, $educationalTool]) }}">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="4" class="text-center"> No hay datos disponibles</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="modal" tabIndex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Estas seguro?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>No podras revertir esto.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger" id="btnDelete">Si, eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                </div>


            </div>

        </div>


    </div>


</x-app-layout>
