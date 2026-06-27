<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-vnn-blue">Welcome Back</h2>
        <p class="text-sm text-gray-500">Sign in to your VNN account</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-vnn-red shadow-sm focus:ring-vnn-red" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-500 hover:text-vnn-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vnn-blue" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-vnn-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vnn-red-dark focus:outline-none focus:ring-2 focus:ring-vnn-red focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" wire:navigate class="font-semibold text-vnn-blue hover:text-vnn-blue-dark underline">Register</a>
        </p>
    </form>
</div>
