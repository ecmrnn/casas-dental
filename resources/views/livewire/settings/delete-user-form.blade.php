<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }

    public function confirmDelete() {
        $this->dispatch('open-modal-confirm', name: 'confirm-user-deletion');
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg poppins-bold text-red-500 shrink-0">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-3 text-sm max-w-lg">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="flex justify-between sm:flex-row-reverse">
        <div>
        </div>

        <x-danger-button
            x-data=""
            wire:click="confirmDelete"
        >{{ __('Delete Account') }}</x-danger-button>
    </div>    


    <x-modal-confirmation name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser">

            <div class="p-5 flex gap-5 items-center border-b border-gray-200">
                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M78-99q-11.483 0-19.894-5.625Q49.696-110.25 46-118q-5.167-6.6-5.583-16.8Q40-145 46-154l403-695q5-9 13.5-13.5T480-867q9 0 17.5 4.5T512-849l403 695q5 9 4.583 19.2-.416 10.2-4.583 16.8-5.044 7.4-13.522 13.2Q893-99 883-99H78Zm63-73h678L480-757 141-172Zm343.86-52q15.14 0 25.64-10.658t10.5-25.5Q521-275 510.325-286q-10.676-11-25.816-11-15.141 0-25.825 10.95Q448-275.099 448-259.825q0 14.85 10.86 25.337Q469.719-224 484.86-224Zm0-122q15.14 0 25.64-10.625T521-383v-153q0-14.775-10.675-25.388Q499.649-572 484.509-572q-15.141 0-25.825 10.612Q448-550.775 448-536v153q0 15.75 10.86 26.375Q469.719-346 484.86-346ZM480-465Z"/></svg>
                <h2 class="text-lg font-medium poppins-bold">
                    {{ __('Deleting Account!') }}
                </h2>
            </div>

            
            <div class="p-5 bg-gray-50">
                <p class="text-sm">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
                <div class="py-2 px-3 mt-5 rounded-lg border border-gray-200 bg-white">
                    <x-input-label for="password" value="{{ __('Password') }}" />
    
                    <x-text-input
                        wire:model="password"
                        id="password"
                        name="password"
                        type="password"
                        class="w-full block"
                        placeholder="{{ __('********') }}"
                    />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="p-5 border-t border-gray-200">
                <div class="flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-danger-button class="ms-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </div>
        </form>
    </x-modal-confirmation>
</section>
