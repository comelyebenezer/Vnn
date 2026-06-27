<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-vnn-blue">Confirm Password</h2>
        <p class="text-sm text-gray-500">Please confirm your password before continuing</p>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form wire:submit="confirmPassword">
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue" type="password" name="password" required autocomplete="current-password" autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-vnn-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vnn-red-dark focus:outline-none focus:ring-2 focus:ring-vnn-red focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</div>
