<!DOCTYPE html>
<html lang="en">
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
<body class="min-h-screen bg-gradient-to-br from-purple-900 via-blue-900 to-gray-900">
<!-- Navigation -->
<nav class="container mx-auto px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <x-application-logo />
        </div>
        <livewire:guest.navigation />
    </div>
</nav>

<!-- Hero Section -->
<div class="container mx-auto px-6 py-16">
    <div class="text-center">
        <h1 class="text-5xl font-bold text-white mb-6">
            Generate Realistic Mock Data <br>
            for Your Applications
        </h1>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Quickly generate fake data for testing and development.
            Simple API, powerful schema definitions, and comprehensive data types.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-lg text-lg hover:opacity-90 inline-block">
                Try It Free
            </a>
            <a href="https://docs.mockwise.dev" class="border border-gray-500 text-white px-8 py-3 rounded-lg text-lg hover:bg-white/10 inline-block">
                View Docs
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container mx-auto px-6 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-white/10 p-6 rounded-lg">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="code" class="text-white"></i>
            </div>
            <h3 class="text-white text-xl font-semibold mb-2">Simple API</h3>
            <p class="text-gray-300">
                Easy-to-use RESTful API with comprehensive documentation and examples
            </p>
        </div>

        <div class="bg-white/10 p-6 rounded-lg">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="database" class="text-white"></i>
            </div>
            <h3 class="text-white text-xl font-semibold mb-2">Rich Data Types</h3>
            <p class="text-gray-300">
                Support for a wide range of data types including personal info, addresses, and more
            </p>
        </div>

        <div class="bg-white/10 p-6 rounded-lg">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="layout-template" class="text-white"></i>
            </div>
            <h3 class="text-white text-xl font-semibold mb-2">Custom Schemas</h3>
            <p class="text-gray-300">
                Define your data structure with flexible JSON schemas
            </p>
        </div>

        <div class="bg-white/10 p-6 rounded-lg">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="key" class="text-white"></i>
            </div>
            <h3 class="text-white text-xl font-semibold mb-2">Secure Access</h3>
            <p class="text-gray-300">
                API token authentication and secure data generation
            </p>
        </div>
    </div>
</div>

<!-- Code Example Section - Simple -->
<div class="container mx-auto px-6 py-16">
    <div class="bg-white/10 rounded-lg p-8">
        <h2 class="text-2xl font-bold text-white mb-6">Try it out - Start simple</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <p class="text-gray-400 mb-4">Request:</p>
                <pre class="text-sm text-gray-300">POST /api/v1/generate
{
  "repeat": 2,
  "mock": {
    "first_name": {
      "type": "firstName"
    },
    "last_name": {
      "type": "lastName"
    }
  }
}</pre>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg">
                <p class="text-gray-400 mb-4">Response:</p>
                <pre class="text-sm text-gray-300">[
    {
        "first_name": "Talon",
        "last_name": "Kilback"
    },
    {
        "first_name": "Amari",
        "last_name": "Olson"
    }
]</pre>
            </div>
        </div>
    </div>
</div>
<!-- Code Example Section 2 Complex -->
<div class="container mx-auto px-6 py-16">
    <div class="bg-white/10 rounded-lg p-8">
        <h2 class="text-2xl font-bold text-white mb-6">Try it out - Advanced</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <p class="text-gray-400 mb-4">Request:</p>
                <pre class="text-sm text-gray-300">POST /api/v1/generate
{
  "locale": "pt_BR",
  "show_errors": true,
  "repeat": 1,
  "single_item": true,
  "mock": {
    "first_name": {
      "type": "firstName"
    },
    "middle_name": {
      "type": "middleName"
    },
    "last_name": {
      "type": "lastName"
    },
    "contact": {
      "type": "mock",
      "params": {
        "locale": "en_CA",
        "show_errors": false,
        "repeat": 3,
        "mock": {
          "phone_number": {
            "type": "phoneNumber"
          }
        }
      }
    }
  }
}</pre>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg">
                <p class="text-gray-400 mb-4">Response:</p>
                <pre class="text-sm text-wrap text-gray-300">{
    "first_name": "Guilherme",
    "last_name": "Matias",
    "contact": [
        {
            "phone_number": "1-137-254-3267"
        },
        {
            "phone_number": "1 (257) 692-6254"
        },
        {
            "phone_number": "+1 (553) 720-8126"
        }
    ],
    "errors": {
        "middle_name": "'middleName' is not a valid type"
    }
}</pre>
            </div>
        </div>
    </div>
</div>

<x-footer />

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
</body>
</html>
