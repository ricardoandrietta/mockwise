@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-gray-800 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-700']) }}>
