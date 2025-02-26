<nav x-data="{ isOpen: false }" class="flex md:flex-1 items-center justify-end">
    <!-- Mobile menu button -->
    <button @click="isOpen = !isOpen"
            class="md:hidden text-gray-300 hover:text-white relative z-50">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

    <!-- Navigation Links -->
    <div class="md:flex md:items-center"
         :class="{ 'hidden': !isOpen, 'block': isOpen }"
         @click.away="isOpen = false">
        <div class="flex flex-col md:flex-row md:space-x-6 absolute md:relative top-20 md:top-0 right-6 md:right-0 bg-gray-800 md:bg-transparent p-4 md:p-0 rounded-lg md:rounded-none shadow-lg md:shadow-none">
            @auth
                <a href="{{ url('/dashboard') }}" class="block py-2 md:py-0 text-gray-300 hover:text-white">Dashboard</a>
            @else
                <a href="https://docs.mockwise.dev" class="block py-2 md:py-0 text-gray-300 hover:text-white">Documentation</a>
                <a href="{{ route('login') }}" class="block py-2 md:py-0 text-gray-300 hover:text-white">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('login') }}" class="block py-2 md:py-0 text-gray-300 hover:text-white">Get Started</a>
                @endif
            @endauth
        </div>
    </div>
</nav>
