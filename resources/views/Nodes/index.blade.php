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
                    <div class="flex-row">
                        <div class="flex-large">
                            <div class="card">
                                <div class="card-header">
                                    <a href="/nodes/create" >Crear nodo</a>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nodo</th>
                                            <th scope="col">Administrador</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($nodes as $node)
                                            <tr>
                                                <td>{{ $node->state }}</td>
                                                <td>{{ $node->administrator->user->name }}</td>
                                                <td class="actions">
                                                    <div class="actions-wrapper">
                                                        <a href="/app/nodes/edit/{{ $node->id }}" > Editar </a>
                                                        <a href="/app/nodes/detail/{{ $node->id }}" > Detail </a>
                                                        <button class="btn" type="button" > Eliminar </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colSpan="4">No Nodes</td>
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
