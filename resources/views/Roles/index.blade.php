<title>{{'Roles'}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-5 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-center md:text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('Roles') }}
                <span class="text-base sm:text-2xl block text-purple-300">
                    Lista de roles
                </span>
            </h2>
        </div>
        @can('create_role')
        <a href="{{ route('roles.create') }}">
            <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Create role')}}
            </div>
        </a>
        @endcan
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Type') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @forelse ($roles as $role)
                            <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">
                                <td>
                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Type') }}</span>
                                    <p>{{ $role->name }}</p>
                                </td>

                                <td class="py-2 text-left">
                                    <div class="lg:flex items-center lg:justify-around">
                                        {{-- ICONOS SOLO VISIBLE EN MOVIL DE PANTALLA -> XS.. A.. MD  --}}
                                        <div class="lg:hidden">
                                            <span class="lg:hidden top-0 left-0 ml-2  px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Actions') }}</span>
                                                @can('show_role')
                                                    <x-jet-dropdown-link class="inline-block" href="{{ route('roles.show', $role->id) }}">
                                                        <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                        </svg>
                                                    </x-jet-dropdown-link>
                                                @endcan
                                                @can('edit_role')
                                                    <x-jet-dropdown-link class="inline-block" href="{{ route('roles.edit', $role->id) }}">
                                                        <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </x-jet-dropdown-link>
                                                @endcan
                                                @can('destroy_role')
                                                    <x-jet-dropdown-link class="modal-open inline-block" onclick="modal('{{ route('roles.destroy',[$role->id]) }}')">
                                                        <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </x-jet-dropdown-link>
                                                @endcan
                                        </div>

                                        {{------------------------------------------------------------------------------------------------------- --}}
                                        {{-- //**********------------------------------------------------------------------------**************// --}}
                                        <div class="hidden lg:table-cell">
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

                                                <x-slot name="content">
                                                    @can('show_role')
                                                    <x-jet-dropdown-link href="{{ route('roles.show', $role->id) }}">
                                                        {{ __('Show') }}
                                                    </x-jet-dropdown-link>
                                                    @endcan
                                                    @can('edit_role')
                                                    <x-jet-dropdown-link href="{{ route('roles.edit', $role->id) }}">
                                                        {{ __('Edit') }}
                                                    </x-jet-dropdown-link>
                                                    @endcan
                                                    @if(Auth::user()->hasRole(1) || Auth::user()->hasRole(3))
                                                        @can('destroy_role')
                                                            <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('roles.destroy',[$role->id]) }}')">
                                                                {{ __('Delete') }}
                                                            </x-jet-dropdown-link>
                                                        @endcan
                                                    @endif
                                                </x-slot>
                                            </x-jet-dropdown>
                                        </div>
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
