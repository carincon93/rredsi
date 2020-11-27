<x-app-layout>

    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Educational environments') }}
            <span class="sm:block text-purple-300">
                Add educational environment
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.educational-environments.create', [$node, $educationalInstitution]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Create educational environment')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                        <div class="flex-row">
                            <div class="flex-large">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="/educational-environments/create" class="btn btn-primary">Crear</a>
                                            <a href="/educational-environments/loan-request" class="btn btn-secondary">Solicitudes de prestamos</a>
                                            <a href="/educational-environments/loan-returns" class="btn btn-secondary">Devoluciones de ambientes</a>
                                        </div>
                                    </div>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Institucion educativa</th>
                                                <th>Tipo de ambiente</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($educationalEnvironments as $educationalEnvironment)
                                                <tr>
                                                    <td>{{ $educationalEnvironment->name }}</td>
                                                    <td>{{ $educationalEnvironment->educationalInstitution->name }}</td>
                                                    <td>{{ $educationalEnvironment->type }}</td>
                                                    <td class="actions">
                                                        <div class="actions-wrapper">
                                                            <a href="/app/educational-environments/edit/{{ $educationalEnvironment->id }}"> Editar </a>
                                                            <a href="/app/educational-environments/detail/{{ $educationalEnvironment->id }}"> Detalle </a>
                                                            <button class="btn btn-danger" type="button" >Eliminar </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colSpan="6">No educational environments</td>
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
