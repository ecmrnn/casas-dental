<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="lg:flex">
        <livewire:layout.navigation />

        <main class="mb-14 sm:mb-0 md:p-5 lg:p-10 overflow-auto w-full bg-gray-50/90">
            <!-- Page Heading -->
            @if (isset($header))
            <header class="mb-5 sm:mb-10">
                <div class="flex justify-between items-center">
                    <h1 class="p-5 pb-0 md:p-0 poppins-bold font-semibold text-3xl sm:text-4xl leading-none">
                        {{ $header }}
                    </h1>
                    <div class="hidden lg:flex">
                        @livewire('layout.header')
                    </div>
                </div>
            </header>
            @endif
                
            <!-- Page Content -->
            {{ $slot }}
        </main>
    </body>
</html>
