<div>
    <button
        type="button"
        class="w-full flex items-center justify-center gap-2 px-4 py-2 my-6 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
        @click="window.location.href = '{{ route('auth.redirect', ['provider' => strtolower($provider)]) }}'"
    >
        {!! $this->providerIcon !!}
        Continue with {{ $provider }}
    </button>
</div>
