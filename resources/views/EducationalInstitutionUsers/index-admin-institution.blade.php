<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Requests') }}
            <span class="text-base sm:text-2xl block text-purple-300">
                Lista de solicitudes de participacion en proyectos
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
                                {{ __('Request participation') }}
                            </a>
                        </li>
                    </ul>

                    <div class="py-5 flex-auto">
                        <div class="tab-content tab-space">
                            <div class="block" id="tab-noleidos">
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto">
                                        <div class="bg-white shadow-xl sm:rounded-lg">
                                            <x-data-table>
                                                <x-slot name="firstTheadTitle">
                                                    {{ __('Notification') }}
                                                </x-slot>

                                                <x-slot name="tbodyData">
                                                    @foreach ($user->notifications as $notification)

                                                     @if($notification->type == "App\Notifications\NotificationToParticipate")

                                                        <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">
                                                            <td>
                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('subject') }}</span>
                                                                <div class="ml-2 w-auto text-gray-400 mt-4">
                                                                    {{ $notification->data['subject'].' (Fecha y hora: '.$notification->created_at.')' }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('message') }}</span>
                                                                <div class="ml-2 w-auto ">
                                                                    {{ $notification->data['message'] }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('thanksMessage') }}</span>
                                                                <div class="ml-2 w-auto ">
                                                                    {{ $notification->data['thanksMessage'] }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Request response') }}</span>
                                                                <div class="ml-2 w-auto ">
                                                                    {{-- {{ $notification->data['request_id'] }} --}}
                                                                    @foreach ($requests as $request )
                                                                        @if ($notification->data['request_id'] == $request->id)

                                                                            @if(is_null($request->status))
                                                                                <span class="top-0 left-0 px-2 text-blue-400 py-1 text-xs font-bold uppercase block">
                                                                                    {{"Todavía no hay respuesta a esta solicitud"}}
                                                                                </span>
                                                                                @else
                                                                                @if($request->status == 1)
                                                                                    <span class="top-0 left-0 px-2 text-green-400 py-1 text-xs font-bold uppercase block">
                                                                                        {{"Solicitud aceptada"}}
                                                                                    </span>
                                                                                @elseif ($request->status == 0)
                                                                                    <span class="top-0 left-0 px-2 text-red-400 py-1 text-xs font-bold uppercase block">
                                                                                        {{"Solicitud rechazado"}}
                                                                                    </span>

                                                                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Comments') }}</span>
                                                                                    <div class="ml-2 w-auto ">
                                                                                        {{ $request->comment }}
                                                                                    </div>
                                                                                @endif
                                                                            @endif

                                                                        @endif

                                                                    @endforeach
                                                                </div>

                                                                {{-- @if( $notification->type !== 'App\Notifications\RequestResponse' && $notification->type !== 'App\Notifications\InformationNotification')
                                                                    <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('action') }}</span>
                                                                    <a href="{{ $notification->data['action'] }}" class="mb-4 inline-block">
                                                                        <p class="ml-2 w-48 mt-2 lg:w-96" >Visita el siguiente enlace {{ $notification->data['action'] }}</p>
                                                                    </a>
                                                                @endif --}}
                                                            </td>
                                                            <td class="py-2 text-left">
                                                                <div class="lg:flex items-center lg:justify-around">

                                                                    {{-- ICONOS SOLO VISIBLE EN MOVIL DE PANTALLA -> XS.. A.. MD  --}}
                                                                    <div class="lg:hidden">
                                                                        <span class="lg:hidden top-0 left-0 ml-2  px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Actions') }}</span>
                                                                        @if( $notification->type !== 'App\Notifications\RequestResponse' && $notification->type !== 'App\Notifications\InformationNotification')
                                                                            <x-jet-dropdown-link class="inline-block" href="{{ route('requests.show', [$notification->id]) }}">
                                                                                <svg class="inline p-0 m-0 h-5 w-6 mb-2 hover:cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                                                </svg>
                                                                            </x-jet-dropdown-link>
                                                                        @endif

                                                                    </div>

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
                                                                                @if( $notification->type !== 'App\Notifications\RequestResponse' && $notification->type !== 'App\Notifications\InformationNotification')
                                                                                <x-jet-dropdown-link href="{{ route('requests.show', [$notification->id])}}">
                                                                                    {{ __('Show') }}
                                                                                </x-jet-dropdown-link>
                                                                                @endif
                                                                            </x-slot>
                                                                        </x-jet-dropdown>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
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

    {{-- #Component modal --}}
    <x-dialog-delete-item />

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>
