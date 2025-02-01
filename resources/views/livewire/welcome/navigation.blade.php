<nav class="-mx-3 flex flex-1 justify-end space-x-6">

    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Dashboard
        </a>
    @else
        <a href="#" class="text-gray-300 hover:text-white">Documentation</a>
        <a href="#" class="text-gray-300 hover:text-white">Pricing</a>
        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Log in </a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Get Started</a>
        @endif
    @endauth
</nav>
