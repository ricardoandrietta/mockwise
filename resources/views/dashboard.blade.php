<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-effect overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-6 text-gray-200">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6">
                    <x-input-label for="name" :value="__('This is your API Token')" />
                    <x-text-input id="api_token" name="api_token" type="text" class="mt-1 block w-full" readonly value="{{ \Illuminate\Support\Facades\Auth::user()->tokens->first() }}" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
