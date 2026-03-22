<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-zinc-900">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-zinc-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
        </div>
        <div 
            x-data="{ 
                show: false, 
                message: '',
                init() {
                    window.addEventListener('show-error-toast', (event) => {
                        this.message = event.detail.message; 
                        this.show = true; 
                        setTimeout(() => { 
                            this.show = false; 
                        }, 3000);
                    });
                }
            }"
            x-show="show"
            x-transition.opacity.duration.300ms
            class="fixed bottom-4 right-4 z-[9999] bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg font-semibold pointer-events-none"
        >
            <span x-text="message"></span>
        </div>
    </body>
</html>
