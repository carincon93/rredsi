<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-white text-left text-2xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Educational institutions') }}
            <span class="text-base sm:text-3xl block text-purple-300">
                Add Educational institutions info
            </span>
        </h2>
        <div>
            @can('create_educational_institution')
            <a href="{{ route('nodes.educational-institutions.create', [$node]) }}">
                <div class="w-auto text-center text-base sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-3 md:px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Create educational institution') }}
                </div>
            </a>
            @endcan
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm-rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Name') }}
                    </x-slot>
                    <x-slot name="secondTheadTitle">
                        {{ __('City') }}
                    </x-slot>
                    <x-slot name="thirdTheadTitle">
                        {{ __('Administrator') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @foreach ($educationalInstitutions as $educationalInstitution)
                            <tr class="bg-white">
                                <td>
                                    <span>{{ $educationalInstitution->name }}</span>
                                </td>
                                <td class="hidden sm:table-cell">
                                    <span>{{ $educationalInstitution->city }}</span>
                                </td>
                                <td class="hidden lg:table-cell">
                                    <span><span class="capitalize">{{ optional($educationalInstitution->administrator)->name }}</span></span>
                                </td>
                                <td class="py-2 text-left">
                                    <div class="flex items-center justify-around">
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
                                                @can('show_educational_institution')
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.show', [$node, $educationalInstitution]) }}">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                @can('edit_educational_institution')
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.edit', [$node, $educationalInstitution]) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                @can('destroy_educational_institution')
                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('nodes.educational-institutions.destroy', [$node, $educationalInstitution]) }}')">
                                                    {{ __('Delete') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.faculties.index', [$node, $educationalInstitution]) }}">
                                                    {{ __('Manage educational institution faculties') }}
                                                </x-jet-dropdown-link>
                                            </x-slot>
                                        </x-jet-dropdown>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
