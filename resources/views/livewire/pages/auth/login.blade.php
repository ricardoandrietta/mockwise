<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h2 class="text-3xl font-bold text-white mb-6 text-center">{{ __('Welcome Back') }}</h2>

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="mb-4 font-medium text-sm text-red-700">
        {{ $errors->first() }}
    </div>

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300"/>
            <x-text-input wire:model="form.email" id="email"
                          class="w-full px-4 py-3 bg-gray-800 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-700"
                          type="email" name="email" required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300"/>
            <x-text-input wire:model="form.password" id="password"
                          class="w-full px-4 py-3 bg-gray-800 rounded-lg text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-700"
                          type="password" name="password" required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                       class="rounded border-gray-700 bg-gray-800 text-blue-500 focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-400 hover:text-blue-300" href="{{ route('password.request') }}"
                   wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:opacity-90">
            {{ __('Log in') }}
        </x-primary-button>

        <hr class="border-gray-500 dark:border-white"/>

        <livewire:actions.social-login provider="Google" />
        <livewire:actions.social-login provider="GitHub" />

    </form>
</div>
