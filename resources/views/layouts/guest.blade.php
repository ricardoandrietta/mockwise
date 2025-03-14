<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @production
        <script defer src="https://cloud.umami.is/script.js" data-website-id="{{ env('UMAMI_WEBSITE_ID') }}"></script>
    @endproduction

</head>
<body class="relative font-sans antialiased">

<!-- Background wrapper -->
<div class="fixed inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900"></div>
<div class="fixed inset-0 bg-black opacity-20"></div>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

    <div class="relative">
        <a href="/" wire:navigate>
            <x-application-logo class="w-20 h-20 fill-current text-white"/>
        </a>
    </div>

    <div
        class="relative w-full sm:max-w-md mt-6 px-6 py-4 glass-effect shadow-2xl sm:rounded-2xl border border-gray-600">
        {{ $slot }}
    </div>
</div>
</body>
</html>
