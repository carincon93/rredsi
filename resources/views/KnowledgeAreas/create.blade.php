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
                    <div class="form-wrapper">
                        <form method="POST" action="{{ route('knowledge-areas.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                {{-- <small id="nameHelp" class="form-text text-muted">
                                    Campo requerido
                                </small> --}}
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    defaultValue=""
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">
                                    {{-- {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''} --}}
                                </span>
                            </div>

                            <button class="btn btn-primary" type="submit" > Guardar </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>


</x-app-layout>
