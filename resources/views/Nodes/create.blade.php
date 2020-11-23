<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nodes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                        <form action={{ route('nodes.store') }} method="POST" >
                            @csrf

                            <div class="form-group">
                                <label for="state">state</label>
                                {{-- <small id="stateHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <input
                                    type="text"
                                    id="state"
                                    name="state"
                                    class="form-control"
                                    required
                                >
                                </input>
                                <span class="invalid-feedback">
                                    {{-- {rules.state.message ? rules.state.message : requestValidation.state ? requestValidation.state : ''} --}}
                                </span>
                            </div>



                            <div class="form-group">
                                <label for="administrator_id">administrator_id</label>
                                {{-- <small id="administrador_idHelp" class="form-text text-muted">Campo requerido</small> --}}
                                <select id="administrator_id"
                                    name="administrator_id"
                                    class="form-control"
                                    required
                                >
                                    <option value=''>Seleccione un administrador</option>

                                    {{-- @forelse ($nodeAdmins as $nodeAdmin)
                                            <option value={{ $nodeAdmin->user->id }} > {{ $nodeAdmin->user->name }} </option>
                                    @empty
                                        <option value="">No educational institutions</option>
                                    @endforelse --}}

                                </select>
                                <span class="invalid-feedback">
                                    {{-- {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''} --}}
                                </span>
                            </div>

                            <button  type="submit"> Guardar  </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>

</x-app-layout>
