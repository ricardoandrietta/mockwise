<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900">
<div class="min-h-screen container mx-auto px-6 py-4">
    @auth
        <livewire:logged.navigation />
    @else
        <livewire:guest.navigation />
    @endauth

    @if (isset($header))
        <header class="container mx-auto px-6 py-4">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <main class="container mx-auto px-6 py-4">
        {{ $slot }}
    </main>
</div>
<x-footer />
</body>
</html>
