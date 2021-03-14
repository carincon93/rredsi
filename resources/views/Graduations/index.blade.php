<title>{{"Información de grados"}}</title>
<x-app-layout>
    <x-slot name="header">
        <div class="col-start-2 col-span-4 md:col-start-1 md:col-span-3 xl:col-start-1 xl:col-span-3">
            <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
                {{ __('User graduations') }}
                <span class="sm:block text-purple-300">
                    Lista de información de grado
                </span>
            </h2>
        </div>

        @can('create_graduation')
        <a href="{{ route('user.profile.user-graduations.create') }}">
            <div class="w-full sm:w-auto items-center justify-center text-blue-900 group-hover:text-blue-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Create graduation')}}
            </div>
        </a>
        @endcan
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

                            <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">

                                <td>
                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Name') }}</span>
                                    <p>{{ $userGraduation->academicProgram->name }}</p>
                                </td>

                                <td>
                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Educational institution') }}</span>
                                    <p class="">{{ $userGraduation->academicProgram->educationalInstitutionFaculty->educationalInstitution->name }}</p>
                                </td>

                                <td>
                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Year') }}</span>
                                    <p class="">{{ $userGraduation->year }}</p>
                                </td>

                                <td class="py-2 text-left">
                                    <div class="lg:flex items-center lg:justify-around">

                                        {{-- ICONOS SOLO VISIBLE EN MOVIL DE PANTALLA -> XS.. A.. MD  --}}

                                        <div class="lg:hidden">
                                            <span class="lg:hidden top-0 left-0 ml-2  px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Actions') }}</span>
                                            @can('show_knowledge_subarea_discipline')
                                                <x-jet-dropdown-link class="inline-block" href="{{ route('user.profile.user-graduations.show', [$userGraduation]) }}">
                                                    <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                    </svg>
                                                </x-jet-dropdown-link>
                                            @endcan
                                            @can('edit_knowledge_subarea_discipline')
                                                <x-jet-dropdown-link class="inline-block" href="{{ route('user.profile.user-graduations.edit', [$userGraduation]) }}">
                                                    <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </x-jet-dropdown-link>
                                            @endcan
                                            @can('destroy_knowledge_subarea_discipline')
                                                <x-jet-dropdown-link class="modal-open inline-block" onclick="modal('{{ route('user.profile.user-graduations.destroy', [$userGraduation]) }}')">
                                                    <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </x-jet-dropdown-link>
                                            @endcan

                                            <x-jet-dropdown-link class="inline-block" href="{{ route('user.profile.user-graduations.user-academic-works.index', [$userGraduation]) }}">
                                                <svg  class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" /><path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                                </svg>
                                            </x-jet-dropdown-link>

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
                                                    @can('show_graduation')
                                                    <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.show', [$userGraduation]) }}">
                                                        {{ __('Show') }}
                                                    </x-jet-dropdown-link>
                                                    @endcan
                                                    @can('edit_graduation')
                                                    <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.edit', [$userGraduation]) }}">
                                                        {{ __('Edit') }}
                                                    </x-jet-dropdown-link>
                                                    @endcan
                                                    @can('destroy_graduation')
                                                    <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('user.profile.user-graduations.destroy', [$userGraduation]) }}')">
                                                        {{ __('Delete') }}
                                                    </x-jet-dropdown-link>
                                                    @endcan
                                                    <x-jet-dropdown-link href="{{ route('user.profile.user-graduations.user-academic-works.index', [$userGraduation]) }}">
                                                        {{ __('Manage academic works') }}
                                                    </x-jet-dropdown-link>
                                                </x-slot>
                                            </x-jet-dropdown>
                                        </div>
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
