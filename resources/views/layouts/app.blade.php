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
<body class="relative font-sans">

<!-- Background wrapper -->
<div class="fixed inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900"></div>
<div class="fixed inset-0 bg-black opacity-20"></div>

<!-- Content wrapper -->
<div class="relative flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <x-application-logo />
            <livewire:logged.navigation />
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-4">
        {{ $slot }}
    </main>
</div>
<x-footer />
</body>
</html>
