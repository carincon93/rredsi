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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                <x-data-table>
                    <x-slot name="firstTheadTitle">
                        {{ __('Notification') }}
                    </x-slot>

                    <x-slot name="tbodyData">
                        @foreach ($notifications as $notification)

                            <tr class="bg-white border-t">

                                <td>
                                    <span class="text-gray-400 mt-4 inline-block">{{ $notification->data['subject'].' (Fechay  hora: '.$notification->created_at.')' }}</span>
                                    <p class="mt-2">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <a href="{{ $notification->data['action'] }}" class="mb-4 inline-block">Visita el siguiente enlace {{ $notification->data['action'] }}</a>
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
                                                <x-jet-dropdown-link href="#">
                                                    {{ __('Show') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="#">
                                                    {{ __('Edit') }}
                                                </x-jet-dropdown-link>
                                                <x-jet-dropdown-link href="#">
                                                    {{ __('Delete') }}
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
