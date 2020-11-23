<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Eventos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">

                    <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                            <div>
                                <a class="text-indigo-600 hover:text-indigo-900" href="/events/create">Crear evento</a>
                            </div>

                            <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lugar</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de inicio</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de finalización</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @forelse ($events as $event)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $event->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $event->location }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $event->description }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $event->start_date }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $event->end_date }}</div>
                                                </td>

                                                <td class="action">
                                                    <div class="actions-wrapper">
                                                        <a class="text-indigo-600 hover:text-indigo-900" href={{ route('events.edit',$event->id) }}> Editar </a>
                                                        <a class="text-indigo-600 hover:text-indigo-900" href={{ route('events.show',$event->id) }}> Detail </a>

                                                        <a class="text-red-600 hover:text-red-900" href="#" >Eliminar </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">No Academic Programs</div>
                                                </td>
                                            </tr>

                                        @endforelse

                                <!-- More rows... -->
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



