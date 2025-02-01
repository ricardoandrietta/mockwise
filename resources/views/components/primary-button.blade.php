<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-semibold text-sm tracking-wide transition-all duration-150']) }}>
    {{ $slot }}
</button>
