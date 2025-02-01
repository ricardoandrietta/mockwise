<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()?->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()?->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <h2 class="text-2xl font-bold text-white mb-6 text-center">{{ __('Verify Email') }}</h2>

    <div class="mb-4 text-sm text-gray-300">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    <div wire:loading.delay class="mt-6 flex items-center justify-between">
        <p style="color: #9ca3af">Sending email...</p>
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between">
        <x-primary-button wire:click="sendVerification" wire:loading.remove>
            {{ __('Resend Verification Email') }}
        </x-primary-button>

        <button wire:click="logout" type="submit" class="text-sm text-blue-400 hover:text-blue-300">
            {{ __('Log Out') }}
        </button>
    </div>

</div>
