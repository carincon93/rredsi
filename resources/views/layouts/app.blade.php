<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.6.0/hint.min.css" defer></script> --}}
    </head>

    <body class="font-sans antialiased leading-normal tracking-normal">

        <div class="min-h-screen bg-gray-100 flex flex-wrap">


            <x-navigation-sidebar/>

            <!-- Page Content -->
            {{-- {{ request()->route('node') ? ' lg:pl-64' : '' }} --}}
            <main class="w-full bg-gray-100 pl-0 md:pl-64 lg:pl-64 min-h-screen">
                @livewire('navigation-dropdown')

                 <!-- Page Heading -->
                <header class="bg-gradient-to-l pt-5 md:pt-0 from-blue-900 to-blue-900 shadow">

                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                        {{ $header }}
                    </div>
                </header>

                <div class="p-6 bg-gray-100 mb-20"">
                    {{ $slot }}
                </div>

            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
    </body>
</html>
