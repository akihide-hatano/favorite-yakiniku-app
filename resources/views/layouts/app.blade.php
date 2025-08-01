<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=BIZ+UDGothic&display=swap" rel="stylesheet">

         {{-- Favicon --}}
        <link rel="icon" href="{{ asset('images/yakiniku-logo-icon.png') }}" type="image/png" sizes="16x16">
        <link rel="shortcut icon" href="{{ asset('images/yakiniku-logo-icon.png') }}" type="image/png">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                cursor: url('{{ asset("images/yakiniku-cursor.png") }}'), auto;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        <x-footer />
    </body>
</html>
