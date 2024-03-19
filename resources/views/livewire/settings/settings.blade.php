<div>
    <x-slot name="header">
        {{ __('Settings') }}
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <div class="px-5 md:px-0 space-y-5">
            <div class="p-4 sm:m-0 sm:p-5 rounded-lg bg-white border border-gray-200 sm:rounded-lg">
                <div>
                    <livewire:settings.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:m-0 sm:p-5 rounded-lg bg-white border border-gray-200 sm:rounded-lg">
                <div>
                    <livewire:settings.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:m-0 sm:p-5 rounded-lg bg-white border border-red-400 sm:rounded-lg">
                <div>
                    <livewire:settings.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</div>
