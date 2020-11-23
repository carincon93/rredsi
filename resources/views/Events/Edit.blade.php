<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar evento {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="form-wrapper">
                        <form class="form" action="" method="" id="form" >
                            <div class="form-group">
                                <label for="name">Nombre: </label>
                                <small id="nameHelp" class="form-text text-muted">
                                    Campo requerido
                                </small>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    Value={{ $event->name }}
                                    aria-describedby="nameHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="location">Lugar: </label>
                                <input
                                    type="text"
                                    name="location"
                                    class="form-control"
                                    id="location"
                                    Value={{ $event->location }}
                                    aria-describedby="nameHelp"
                                    maxLength={rules.location.max}
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>
                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <textarea
                                    name="description"
                                    id="description"
                                    Value={{ $event->description }}
                                    class="form-control"
                                >{{ $event->description }}</textarea>
                                <div class="invalid-feedback">
                                    {{-- {rules.description.message ? rules.description.message : requestValidation.description ? requestValidation.description : ''} --}}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="form-row">

                                    <div class="col">
                                        <label for="start_date">Fecha de inicio: </label>
                                        <small id="start_datelHelp" class="form-text text-muted">Campo requerido</small>
                                        <input
                                            type="date"
                                            name="start_date"
                                            class="form-control"
                                            id="start_date"
                                            Value={{ $event->start_date }}
                                            aria-describedby="nameHelp"
                                            maxLength=""
                                            required
                                        />
                                        <span class="invalid-feedback">

                                        </span>
                                    </div>

                                    <div class="col">
                                        <label for="end_date">Fecha final: </label>
                                        <small id="start_datelHelp" class="form-text text-muted">Campo requerido</small>
                                        <input
                                            type="date"
                                            name="end_date"
                                            class="form-control"
                                            id="end_date"
                                            Value={{ $event->end_date }}
                                            aria-describedby="nameHelp"
                                            maxLength=""
                                            required
                                        />
                                        <span class="invalid-feedback">

                                        </span>
                                    </div>

                                </div>


                            </div>

                            <div class="form-group">
                                <label for="link">Link: </label>
                                <input
                                    type="text"
                                    name="link"
                                    class="form-control"
                                    id="link"
                                    Value={{ $event->link }}
                                    aria-describedby="linkHelp"
                                    maxLength=""
                                    required
                                />
                                <span class="invalid-feedback">

                                </span>
                            </div>




                            <button class="btn btn-primary" type="submit" form="form"> Guardar </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>

</x-app-layout>

