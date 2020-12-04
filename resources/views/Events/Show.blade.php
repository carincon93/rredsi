<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle evento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                <div class="container">
                    <div class="card p-4 detail">
                        <div class="card-header">
                            <h4>{{ $event->name }}</h4>
                            <a class="text-indigo-600 hover:text-blue-900"  href={{ route('events.edit',$event->id) }} > Editar </a>
                        </div>
                        <hr></hr>
                        <ul class="list-unstyled">
                            <li class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Lugar: </h5>
                                    {{ $event->location }}
                                </div>
                            </li>
                            <li class="media my-4">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Descripción: </h5>
                                    {{ $event->description }}
                                </div>
                            </li>
                            <li class="media my-4">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Fechas: </h5>
                                    {{ $event->start_date }} al {{ $event->end_date }}
                                </div>
                            </li>
                            <li class="media my-4">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">Link: </h5>
                                    {{ $event->link }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>


    </div>

</x-app-layout>
