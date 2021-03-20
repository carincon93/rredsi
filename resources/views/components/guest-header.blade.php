<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 bg-white {{ $image ? ' lg:max-w-2xl xl:pb-32 lg:pb-28 sm:pb-16 md:pb-20 pb-8' : '' }} lg:w-full">
            @if ($image)
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            @endif

            <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
                    <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                        <div class="flex items-center justify-between w-full md:w-auto">
                            <a href="{{ route('nodes.explorer', [$node]) }}">
                                <span class="sr-only">Workflow</span>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9.78" height="36.859" viewBox="0 0 9.78 36.859" class="h-8 w-auto sm:h-10">
                                    <defs>
                                      <linearGradient id="linear-gradient" x1="0.5" x2="1.131" y2="1.374" gradientUnits="objectBoundingBox">
                                        <stop offset="0" stop-color="#163a70"/>
                                        <stop offset="1" stop-color="#913fd8"/>
                                      </linearGradient>
                                    </defs>
                                    <path  d="M10539.774,23271h0v0l-3.534,0v-32.4l3.536-1.785Zm-5.786,0h-3.693v-30.574l-.293-3.109,3.986,1.279v32.4Z" transform="translate(-10529.994 -23234.141)" fill="url(#linear-gradient)"/>
                                    <path d="M.062,3.182,6.151,0h0" transform="translate(0.169 0.443)" fill="none" stroke="#163a70" stroke-width="1"/>
                                </svg>
                            </a>
                            <div class="-mr-2 flex items-center md:hidden">
                                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" id="main-menu" aria-haspopup="true">
                                    <span class="sr-only">Open main menu</span>
                                    <!-- Heroicon name: menu -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                        <a href="{{ route('nodes.explorer.nodeInfo', [$node]) }}" class="font-medium text-gray-500 hover:text-gray-900">RREDSI <span class="capitalize">{{ $node->state }}</span></a>

                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard', [$node]) }}" class="font-medium text-blue-900 hover:text-indigo-500">{{ __('Dashboard') }}</a>
                            @else
                                <a href="{{ route('login') }}" class="font-medium text-blue-900 hover:text-indigo-500">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="font-medium text-blue-900 hover:text-indigo-500">{{ __('Register') }}</a>
                                @endif
                            @endif
                        @endif
                    </div>
                </nav>
            </div>

            <!--
                Mobile menu, show/hide based on menu open state.

                Entering: "duration-150 ease-out"
                From: "opacity-0 scale-95"
                To: "opacity-100 scale-100"
                Leaving: "duration-100 ease-in"
                From: "opacity-100 scale-100"
                To: "opacity-0 scale-95"
            -->
            <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <div>
                            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                        </div>
                        <div class="-mr-2">
                            <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Close main menu</span>
                                <!-- Heroicon name: x -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div role="menu" aria-orientation="vertical" aria-labelledby="main-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1" role="none">
                            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50" role="menuitem">RREDSI Caldas</a>
                        </div>
                        @if (Route::has('login'))
                            @auth
                                <div role="none">
                                    <a href="{{ route('dashboard') }}" class="block w-full px-5 py-3 text-center font-medium text-blue-900 bg-gray-50 hover:bg-gray-100" role="menuitem">{{ __('Dashboard') }}</a>
                                </div>
                            @else
                                <div role="none">
                                    <a href="{{ route('login') }}" class="block w-full px-5 py-3 text-center font-medium text-blue-900 bg-gray-50 hover:bg-gray-100" role="menuitem">{{ __('Login') }}</a>
                                </div>
                                @if (Route::has('register'))
                                    <div role="none">
                                        <a href="{{ route('register') }}" class="block w-full px-5 py-3 text-center font-medium text-blue-900 bg-gray-50 hover:bg-gray-100" role="menuitem">{{ __('Register') }}</a>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28{{ !$image ? ' p-24' : '' }}" style="{{ !$image ? 'background:url(/storage/images/net.png);' : ''}}">
                <div class="sm:text-center lg:text-left" style="{{ !$image ? 'background:url(/storage/images/dots.png);background-size: cover;background-position: right;background-repeat: no-repeat;' : ''}}">
                    {{ $title }}
                    <p class="pre-line-initial mt-3 text-base text-gray-500 sm:mt-5 md:mt-5 lg:mx-0{{ !$image ? ' text-center text-2xl w-full' : ' sm:text-lg sm:max-w-xl sm:mx-auto' }}">
                        {{ $textBase }}
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow{{ !$image ? ' bg-white mx-auto' : '' }}">
                            {{ $actionButton }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @if ($image)
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ url("storage/$image") }}" alt="">
        </div>
    @endif
</div>
