<div>
    <x-slot name="header">
        {{ __('Settings') }}
    </x-slot>

    <div>
        <div class="space-y-5">
            <div class="m-5 p-4 sm:p-5 rounded-lg bg-white border border-gray-200 sm:rounded-lg">
                <div>
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="m-5 p-4 sm:p-5 rounded-lg bg-white border border-gray-200 sm:rounded-lg">
                <div>
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="m-5 p-4 sm:p-5 rounded-lg bg-white border border-red-400 sm:rounded-lg">
                <div>
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</div>
