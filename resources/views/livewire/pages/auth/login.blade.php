<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Logo --}}
    <div class="absolute top-1 left-1 sm:top-5 sm:left-5">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" wire:navigate class="p-5 shrink-0 min-w-72 flex items-center">
            <div>
                <x-application-logo />
            </div>
        </a>
    </div>

    <hgroup>
        <p class="poppins-bold">Welcome Back,</p>
        <h1 class="mb-5 text-3xl font-bold poppins-bold">Doc. Chona!</h1>
    </hgroup>

    <form wire:submit="login" class="space-y-2" autocomplete="off">
        <!-- Email Address -->
        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block w-full focus-visible:outline-none" type="email" name="email" placeholder="hello.chona" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="form.password" id="password" class="block w-full"
                            type="password"
                            name="password"
                            placeholder="********"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center">
            @if (Route::has('password.request'))
                <a class="text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-auto">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</div>
