<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public $address = '';
    public $contact_number = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->address = Auth::user()->address;
        $this->contact_number = Auth::user()->contact_number;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'address' => ['nullable', 'string', 'min:5', 'max:255'],
            'contact_number' => ['nullable', 'digits:11|numeric'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium poppins-bold">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-2">
        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model.live.debounce.500="name" id="name" name="name" type="text" class="block w-full capitalize" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model.live.debounce.500="email" id="email" name="email" type="email" class="block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model.live.debounce.500="address" id="address" name="address" type="text" class="block w-full capitalize" required autofocus autocomplete="address" placeholder="Adress (Optional)" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="py-2 px-3 rounded-lg border border-gray-200">
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input wire:model.live.debounce.500="contact_number" id="contact_number" name="contact_number" type="text" class="block w-full" required autofocus autocomplete="contact_number" placeholder="Contact Number (Optional)" />
            <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
        </div>

        <div class="flex w-full items-center justify-between gap-4 sm:flex-row-reverse">
            <div>
                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>

            <x-primary-button>{{ __('Update Profile') }}</x-primary-button>
        </div>
    </form>
</section>
