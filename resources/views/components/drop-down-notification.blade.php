<x-jet-dropdown align="right" classes="flex items-center">

    @php
        /** contamos las notificaciones sin leeer para mostarrlar en el dropdown */
        $count              = auth()->user()->unreadNotifications->count();
        /** traemos  las  notificaciones sin leer las ultimas 4 ponemos limite en ellas*/
        $notificationUnread = Auth::user()->unreadNotifications()->orderBy('created_at', 'desc')->take(4)->get();
    @endphp

    <x-slot name="trigger">
        <div class="space-x-4 flex justify-around hover:cursor-pointer">
            <span class="relative inline-block">
                <svg class="w-6 h-6 text-gray-700 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{$count}}</span>
            </span>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="right-0 mt-2 bg-white rounded-md shadow-lg overflow-hidden z-20 w-80">
            <div class="py-2">
                {{-- aca recorremos el object de notificaciones sin leer y mostramos en el dropdown --}}
                @forelse ($notificationUnread as $notification)
                    {{-- @php echo $notification; @endphp --}}
                    <div class="px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                    @if( $notification->type !== 'App\Notifications\RequestResponse' && $notification->type !== 'App\Notifications\InformationNotification')
                        <a href="{{route('notifications.show', [$notification->id])}}" class="flex items-center">
                    @else
                        <a href="{{route('notifications.show', [$notification->id])}}" class="flex items-center">
                    @endif
                            <p class="block text-gray-600 text-sm mx-2">
                                <span class="font-bold" href="#">{{$notification->data['subject']}}</span>
                            </p>
                        </a>
                        <p class="flex justify-end text-xs text-gray-400">
                            {{ $notification->created_at->addSeconds(5)->diffForHumans() }}.
                        </p>
                    </div>
                @empty
                    <p class="p-4">{{ __('No data recorded') }}</p>
                @endforelse

            </div>
            <a href="{{ route('notifications.index') }}" class="block text-center font-bold py-2">{{ __('See all notifications') }}</a>
        </div>

    </x-slot>


</x-jet-dropdown>