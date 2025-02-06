<nav class="-mx-3 flex flex-1 justify-end space-x-6">

    @auth
        <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
    @else
        <a href="#" class="text-gray-300 hover:text-white">Documentation</a>
        <a href="#" class="text-gray-300 hover:text-white">Pricing</a>
        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Log in </a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Get Started</a>
        @endif
    @endauth
</nav>
