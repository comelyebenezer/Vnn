<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-vnn-blue">Forgot Password</h2>
        <p class="text-sm text-gray-500">No worries, we'll send you reset instructions</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-500 hover:text-vnn-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vnn-blue" href="{{ route('login') }}" wire:navigate>
                {{ __('Back to login') }}
            </a>

            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-vnn-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vnn-red-dark focus:outline-none focus:ring-2 focus:ring-vnn-red focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Send Reset Link') }}
            </button>
        </div>
    </form>
</div>
