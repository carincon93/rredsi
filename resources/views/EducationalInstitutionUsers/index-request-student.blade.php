<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display text-white text-3xl leading-9 font-semibold sm:text-3xl sm:leading-9">
            {{ __('Requests') }}
            <span class="text-base sm:text-2xl block text-purple-300">
                Lista de solicitudes
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
                                {{ __('Requests') }}
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
                                                    @foreach ($requests as $request)
                                                        <tr class="bg-white flex flex-col flex-no wrap lg:table-row mb-2 lg:mb-0">
                                                            <td>
                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Fecha de solicitud') }}</span>
                                                                <div class="ml-2 w-auto text-gray-400 mt-4">
                                                                    {{ '(Fecha y hora: '.$request->created_at.')'}}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Tipo de solicitud') }}</span>
                                                                <div class="ml-2 w-auto ">
                                                                    {{ $request->type_request }}
                                                                </div>

                                                                <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Respuesta') }}</span>
                                                                <div class="ml-2 w-auto ">

                                                                    @if(is_null($request->status))
                                                                        <span class="top-0 left-0 px-2 text-blue-400 py-1 text-xs font-bold uppercase block">
                                                                            {{"Todavía no hay respuesta a esta solicitud"}}
                                                                        </span>
                                                                    @else
                                                                        @if($request->status == 1)
                                                                            <span class="top-0 left-0 px-2 text-green-400 py-1 text-xs font-bold uppercase block">
                                                                                {{"Usted fue aceptado"}}
                                                                            </span>
                                                                        @elseif ($request->status == 0)
                                                                            <span class="top-0 left-0 px-2 text-red-400 py-1 text-xs font-bold uppercase block">
                                                                                {{"Usted fue rechazado"}}
                                                                            </span>

                                                                            <span class="lg:hidden top-0 left-0 px-2 text-gray-400 py-1 text-xs font-bold uppercase block">{{ __('Comments') }}</span>
                                                                            <div class="ml-2 w-auto ">
                                                                                {{ $request->comment }}
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                </div>
                                                            </td>
                                                            <td>

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

    {{-- #Component modal --}}
    <x-dialog-delete-item />

    {{--Alert component --}}
    @if (session('status'))
        <x-data-alert />
    @endif

</x-app-layout>
