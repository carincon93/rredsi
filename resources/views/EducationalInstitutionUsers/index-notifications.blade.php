<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Notifications') }}
            <span class="sm:block text-purple-300">
                Show all notifications
            </span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-2 md:py-10 sm:px-6 lg:px-8">
            <div class="flex flex-wrap" id="tabs-id">
                <div class="w-full">
                    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-blue-900" onclick="changeActiveTab(event,'tab-noleidos')">
                                {{ __('No leidos') }}
                            </a>
                        </li>
                        <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-900 bg-white" onclick="changeActiveTab(event,'tab-leidos')">
                                {{ __('Leidos') }}
                                <?php  $count = auth()->user()->readNotifications->count(); ?>
                                <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-blue-600 rounded-full">
                                    {{$count}}
                                </span>
                            </a>
                        </li>
                    </ul>



                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">
                            <div class="block" id="tab-noleidos">

                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                        <div class="bg-white shadow-xl sm:rounded-lg">
                                            <x-data-table>
                                                <x-slot name="firstTheadTitle">
                                                    {{ __('Notification') }}
                                                </x-slot>

                                                <x-slot name="tbodyData">
                                                    @foreach ($user->unreadNotifications as $notification)

                                                        <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">
                                                            <td>
                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('subject') }}</span>
                                                                <div class="w-auto text-gray-400 mt-4">
                                                                    {{ $notification->data['subject'].' (Fechay  hora: '.$notification->created_at.')' }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('message') }}</span>
                                                                <div class="w-auto ">
                                                                    {{ $notification->data['message'] }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('thanksMessage') }}</span>
                                                                <div class="w-auto ">
                                                                    {{ $notification->data['thanksMessage'] }}
                                                                </div>

                                                                @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('action') }}</span>
                                                                    <a href="{{ $notification->data['action'] }}" class="mb-4 inline-block">
                                                                        <p class="w-48 mt-2 lg:w-96" >Visita el siguiente enlace {{ $notification->data['action'] }}</p>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td class="py-2 text-left">
                                                                <div class="lg:flex items-center lg:justify-around">

                                                                    {{-- ICONOS SOLO VISIBLE EN MOVIL DE PANTALLA -> XS.. A.. MD  --}}
                                                                    <div class="lg:hidden">
                                                                        <span class="lg:hidden top-0 left-0 ml-2  px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Actions') }}</span>
                                                                        @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                            <x-jet-dropdown-link class="inline-block" href="{{ route('notifications.show', [$notification->id]) }}">
                                                                                <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                                                </svg>
                                                                            </x-jet-dropdown-link>
                                                                        @endif
                                                                        @can('destroy_knowledge_subarea_discipline')
                                                                            <x-jet-dropdown-link class="modal-open inline-block" onclick="modal('{{ route('notifications.destroy', [$notification]) }}')">
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
                                                                                @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                                <x-jet-dropdown-link href="{{ route('notifications.show', [$notification->id])}}">
                                                                                    {{ __('Show') }}
                                                                                </x-jet-dropdown-link>
                                                                                @endif
                                                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('notifications.destroy', [$notification]) }}')">
                                                                                    {{ __('Delete') }}
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

                            </div>
                            <div class="hidden" id="tab-leidos">
                                <div>
                                    <div class="py-12">
                                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                            <div class="bg-white shadow-xl sm:rounded-lg">
                                                <x-data-table id="leidos">
                                                    <x-slot name="firstTheadTitle">
                                                        {{ __('Notification') }}
                                                    </x-slot>

                                                    <x-slot name="tbodyData">
                                                        @foreach ($user->readNotifications as $notification)
                                                        <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">
                                                            <td>
                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('subject') }}</span>
                                                                <div class="w-auto text-gray-400 mt-4">
                                                                    {{ $notification->data['subject'].' (Fechay  hora: '.$notification->created_at.')' }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('message') }}</span>
                                                                <div class="w-auto ">
                                                                    {{ $notification->data['message'] }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('thanksMessage') }}</span>
                                                                <div class="w-auto ">
                                                                    {{ $notification->data['thanksMessage'] }}
                                                                </div>

                                                                @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('action') }}</span>
                                                                    <a href="{{ $notification->data['action'] }}" class="mb-4 inline-block">
                                                                        <p class="w-48 mt-2 lg:w-96" >Visita el siguiente enlace {{ $notification->data['action'] }}</p>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td class="py-2 text-left">
                                                                <div class="lg:flex items-center lg:justify-around">

                                                                    {{-- ICONOS SOLO VISIBLE EN MOVIL DE PANTALLA -> XS.. A.. MD  --}}
                                                                    <div class="lg:hidden">
                                                                        <span class="lg:hidden top-0 left-0 ml-2  px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Actions') }}</span>
                                                                        @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                            <x-jet-dropdown-link class="inline-block" href="{{ route('notifications.show', [$notification->id]) }}">
                                                                                <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                                                </svg>
                                                                            </x-jet-dropdown-link>
                                                                        @endif
                                                                        @can('destroy_knowledge_subarea_discipline')
                                                                            <x-jet-dropdown-link class="modal-open inline-block" onclick="modal('{{ route('notifications.destroy', [$notification]) }}')">
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
                                                                                @if( $notification->type !== 'App\Notifications\RequestResponse')
                                                                                <x-jet-dropdown-link href="{{ route('notifications.show', [$notification->id])}}">
                                                                                    {{ __('Show') }}
                                                                                </x-jet-dropdown-link>
                                                                                @endif
                                                                                <x-jet-dropdown-link class="modal-open hover:cursor-pointer" onclick="modal('{{ route('notifications.destroy', [$notification]) }}')">
                                                                                    {{ __('Delete') }}
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
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
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
