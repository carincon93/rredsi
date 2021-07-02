<title>{{'Ideas Empresariales'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Mis ideas') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    Lista de ideas empresariales de {{$business->name}}
                </span>
            </h2>
        </div>
        <a href="{{ route('business-ideas.create')}}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Agregar idea')}}
            </div>
        </a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Nombre') }}
                    </x-slot>
                    <x-slot name="secondTheadTitle">
                        {{ __('Descripción') }}
                    </x-slot>
                    <x-slot name="thirdTheadTitle">
                        {{ __('Condición') }}
                    </x-slot>
                    <x-slot name="tbodyData">
                        @forelse ($ideas as $idea)
                            <tr class="bg-white">
                                <td>
                                    <span>{{ $idea->name }}</span>
                                </td>
                                <td>
                                    <span>{{ substr($idea->description, 0 ,80) }}@if(count_chars($idea->description) > 80)...@endif</span>
                                </td>
                                <td>
                                    <span>{{ $idea->condition }}</span>
                                    {{-- optional($idea->business)->name --}}
                                </td>
                                <td class="py-2 text-left">
                                    <div class="hidden sm:flex sm:items-center justify-around">
                                        <x-jet-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-sm font-medium text-gray hover:text-blue-900 hover:border-gray-300 focus:outline-none focus:text-black focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div class="ml-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="fill-current h-4 w-4">
                                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>
                                            <!-- Editar permisos can y rutas Show,Edit,Delete -->
                                            <x-slot name="content">
                                                <x-jet-dropdown-link href="{{ route('business-ideas.show', $idea->id)}}">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="{{ route('business-ideas.edit', $idea->id)}}">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('business-ideas.destroy', $idea->id)}}')">
                                                    {{ __('Delete') }}
                                                </x-jet-dropdown-link>
                                            </x-slot>
                                        </x-jet-dropdown>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                    <p class="p-4">{{ __('No data recorded') }}</p>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-data-table>
                {{ $ideas->links()}}
            </div>
        </div>
    </div>

    {{-- #Component modal --}}
    <x-dialog-delete-item />

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>
