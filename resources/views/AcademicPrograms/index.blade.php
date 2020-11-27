<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{__('AcademicPrograms')}}
            <span class="sm:block text-purple-300">
                Add academic program info
            </span>
        </h2>
    <div>
        <a href="{{route('academic-programs.create')}}">
            <div class="w-full sm:w-auto items-center justify-center text-purple-900 group-hover:text-purple-500 font-medium leading-none bg-white rounded-lg shadow-sm group-hover:shadow-lg py-3 px-5 border border-transparent transform group-hover:-translate-y-0.5 transition-all duration-150">
                {{ __('Create academic program info')}}
            </div>
        </a>
    </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm-rounded-lg">
                    <x-data-table>
                        <x-slot name="firstTheadTitle">
                            {{__('name')}}
                        </x-slot>
                        <x-slot name="secondTheadTitle">
                            {{__('code')}}
                        </x-slot>
                        <x-slot name="thirdTheadTitle">
                            {{__('educational institution')}}
                        </x-slot>
                        <x-slot name="fourthTheadTitle">
                            {{__('academic level')}}
                        </x-slot>

                        <x-slot name="tbodyData">
                            @foreach ($academicPrograms as $academicProgram )
                                <tr class="bg-white border-4 border-gray-200">
                                    <td>
                                    <span class="text-center ml-2 font-semibold">{{$academicProgram->name}}</span>
                                    </td>
                                    <td>
                                    <span class="text-center ml-2 font-semibold">{{$academicProgram->code}}</span>
                                    </td>
                                    <td>
                                    <span class="text-center ml-2 font-semibold">{{$academicProgram->educational_institution}}</span>
                                    </td>
                                    <td>
                                    <span class="text-center ml-2 font-semibold">{{$academicProgram->academic_level}}</span>
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
                                                            <x-jet-dropdown-link href="{{ route('graduations.show', $academicProgram->id) }}">
                                                                {{ __('Details') }}
                                                            </x-jet-dropdown-link>
                                                            <x-jet-dropdown-link href="{{ route('graduations.edit', $academicProgram->id) }}">
                                                                {{ __('Edit') }}
                                                            </x-jet-dropdown-link>
                                                            <x-jet-dropdown-link href="{{ route('graduations.destroy', $academicProgram->id) }}">
                                                                {{ __('Delete') }}
                                                            </x-jet-dropdown-link>
                                                        </x-slot>
                                                    </x-jet-dropdown>
                                                    @endforeach
                                                </x-slot>
                                            </x-data-table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                
            </div>
</x-app-layout>