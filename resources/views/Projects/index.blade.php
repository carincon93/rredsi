<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Projects') }}
            <span class="sm:block text-purple-300">
                Projects info
            </span>
        </h2>
        <div>
            <a href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.create', [$node, $educationalInstitution, $researchGroup, $researchTeam]) }}">
                <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Create project')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Title') }}
                    </x-slot>
                    <x-slot name="secondTheadTitle">
                        {{ __('Type') }}
                    </x-slot>
                    <x-slot name="thirdTheadTitle">
                        {{ __('Keywords') }}
                    </x-slot>
                    <x-slot name="fourthTheadTitle">
                        {{ __('Is published?') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @foreach ($projects as $project)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $project->title }}</span>
                                </td>

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $project->type }}</span>
                                </td>

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $project->keywords }}</span>
                                </td>

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $project->is_published }}</span>
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
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.show', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.edit', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('nodes.educational-institutions.research-groups.research-teams.projects.destroy', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}')">
                                                    {{ __('Delete') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="{{ route('nodes.educational-institutions.research-groups.research-teams.projects.research-outputs.index', [$node, $educationalInstitution, $researchGroup, $researchTeam, $project]) }}">
                                                    {{ __('Manage research outputs') }}
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
    <x-dialog-modal />

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif


</x-app-layout>



