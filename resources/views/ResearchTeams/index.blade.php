<x-app-layout>

    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Research teams') }}
            <span class="sm:block text-purple-300">
                Add research teams info
            </span>
        </h2>
        <div>
            @can('create_research_team')
            <a href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.create', [$node, $educationalInstitution, $faculty, $researchGroup]) }}" class="btn btn-primary">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Create research team') }}
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
                        {{ __('Mentor email') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @foreach ($researchTeams as $researchTeam)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $researchTeam->name }}</span>
                                </td>
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $researchTeam->mentor_email }}</span>
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

                                            <x-slot name="content">
                                                @can('show_research_team')
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.show', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                @can('edit_research_team')
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.edit', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                @can('destroy_research_team')
                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.destroy', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}')">
                                                    {{ __('Delete') }}
                                                </x-jet-dropdown-link>
                                                @endcan
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.faculties.research-groups.research-teams.projects.index', [$node, $educationalInstitution, $faculty, $researchGroup, $researchTeam]) }}">
                                                    {{ __('Manage projects') }}
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
