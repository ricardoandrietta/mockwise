<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="Mock Wise - Generate Realistic Mock Data for Development">
    <meta name="description" content="Generate realistic mock data for your applications with our powerful API. Create test data with custom schemas, multiple data types, and secure authentication.">
    <meta name="keywords" content="mock data, fake data, API testing, development tools, test data generation, API mocking, fake API data">
    <meta name="author" content="Mock Wise">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mockwise.dev/">
    <meta property="og:title" content="Mock Wise - Generate Realistic Mock Data for Development">
    <meta property="og:description" content="Generate realistic mock data for your applications with our powerful API. Create test data with custom schemas, multiple data types, and secure authentication.">
    <meta property="og:image" content="https://mockwise.dev/og-image.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://mockwise.dev/">
    <meta property="twitter:title" content="Mock Wise - Generate Realistic Mock Data for Development">
    <meta property="twitter:description" content="Generate realistic mock data for your applications with our powerful API. Create test data with custom schemas, multiple data types, and secure authentication.">
    <meta property="twitter:image" content="https://mockwise.dev/twitter-image.jpg">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cloud.umami.is/script.js" data-website-id="424b67a6-abc3-4654-899f-ed901242387c"></script>

</head>
<body class="relative">

<!-- Background wrapper -->
<div class="fixed inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900"></div>
<div class="fixed inset-0 bg-black opacity-20"></div>

<!-- Content wrapper -->
<div class="relative flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <x-application-logo />
            <livewire:guest.navigation />
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-4">
        @yield('content')
    </main>

    <x-footer />
</div>
<script>
    document.addEventListener('livewire:navigated', () => {
        lucide.createIcons();
    });

    document.addEventListener('livewire:initialized', () => {
        lucide.createIcons();
    });
</script>
</body>
</html>
