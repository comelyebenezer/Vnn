<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Verve News Network') }} — {{ config('app.tagline') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-vnn-blue to-vnn-blue-dark">
            <div class="mb-6 text-center">
                <a href="/" wire:navigate class="flex flex-col items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-vnn-blue font-extrabold text-xl">V</span>
                        </div>
                        <div class="text-left">
                            <div class="text-white font-extrabold text-2xl tracking-tight">VERVE NEWS</div>
                            <div class="text-vnn-red font-bold text-sm tracking-widest">NETWORK</div>
                        </div>
                    </div>
                    <p class="text-gray-300 text-xs mt-1 italic">Truth. Speed. Impact.</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-6 bg-white dark:bg-gray-800 shadow-2xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
