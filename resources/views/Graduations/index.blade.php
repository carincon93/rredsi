<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('User graduations') }}
            <span class="sm:block text-purple-300">
                Add graduation info
            </span>
        </h2>
        <div>
            <a href="{{ route('user.profile.user-graduations.create') }}">
                <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                    {{ __('Create graduation info')}}
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Academic program') }}
                    </x-slot>
                    <x-slot name="secondTheadTitle">
                        {{ __('Educational institution') }}
                    </x-slot>
                    <x-slot name="thirdTheadTitle">
                        {{ __('Year') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @foreach ($userGraduations as $userGraduation)

                            <tr class="bg-white border-4 border-gray-200">

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $userGraduation->academicProgram->name }}</span>
                                </td>

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $userGraduation->academicProgram->educationalInstitution->name }}</span>
                                </td>

                                <td>
                                    <span class="text-center ml-2 font-semibold">{{ $userGraduation->year }}</span>
                                </td>

                                <td class="py-2 text-left">
                                    <div class="hidden sm:flex sm:items-center justify-around">
                                        <x-jet-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-sm font-medium text-gray hover:text-indigo-200 hover:border-gray-300 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out">
                                                    <div class="ml-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="fill-current h-4 w-4">
                                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.show', [$userGraduation]) }}">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.edit', [$userGraduation]) }}">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link class="modal-open" onclick="modal('{{ route('user.profile.user-graduations.destroy', [$userGraduation]) }}')">
                                                    {{ __('Delete') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.user-academic-works.index', [$userGraduation]) }}">
                                                    {{ __('Manage academic works') }}
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
    <x-dialog-modal>

    </x-dialog-modal>

</x-app-layout>
