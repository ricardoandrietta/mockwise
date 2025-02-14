<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mock Wise - Generate Realistic Mock Data for Development</title>

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

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="relative">

<!-- Background wrapper -->
<div class="fixed inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900"></div>

<!-- Content wrapper -->
<div class="relative flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <x-application-logo />
            </div>
            <livewire:guest.navigation />
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-6 py-16">
        @yield('content')
    </main>

    <x-footer />
</div>
<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
</body>
</html>
