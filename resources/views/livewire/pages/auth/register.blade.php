<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-vnn-blue">Create Account</h2>
        <p class="text-sm text-gray-500">Join Verve News Network</p>
    </div>

    <form wire:submit="register">
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-vnn-blue font-semibold" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full border-vnn-blue/20 focus:border-vnn-blue focus:ring-vnn-blue"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-500 hover:text-vnn-blue rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vnn-blue" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-vnn-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-vnn-red-dark focus:outline-none focus:ring-2 focus:ring-vnn-red focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
