<div>
    <div>
        <button wire:click="viewRecord" class="block w-full">
            @if ($isIcon)
                <div class="p-2 m-2 rounded-full border border-transparent hover:border-gray-200 hover:bg-gray-50">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                </div>
            @else
                @if ($isCalendar)
                    <div class="py-1 bg-primary rounded-md hover:bg-primary/90">
                        <p class="text-white text-center text-xs capitalize line-clamp-1">{{ $record->first_name . ", " . substr($record->last_name, 0, 1) . "." }}</p>
                    </div> 
                @else
                    <div class="px-5 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm">
                        <p>View Record</p>
                    </div>
                @endif
            @endif
        </button>
    </div>

    <!-- View Record Modal -->
    <x-modal name="{{ $modalView }}">
        <form method="POST" autocomplete="off" class="text-left">
            <div x-data class="flex items-center justify-between border-b border-gray-200">
                <div class="pl-5 sm:p-5 flex items-center gap-3">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                    <p class="capitalize poppins-bold">Appointment Details</p>
                </div>
                <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                </button>
            </div>  

            <div class="p-5 rounded-lg space-y-2 border-gray-200 bg-gray-50/90">
                <div class="p-3 rounded-lg border border-gray-200 bg-white">
                    <p class="text-xs opacity-50">Purpose</p>
                    <h3 class="poppins-bold text-xl leading-none capitalize">{{ $purpose }}</h3>
                </div>
                <div class="p-3 rounded-lg border border-gray-200 bg-white">
                    
                    <p class="capitalize leading-none">
                        <span class="opacity-50">Status:</span>
                        @if ($status == 'scheduled')
                            @if ($scheduleDate . " " . $scheduleTime > date('Y-m-d H:i:s'))
                                {{ __("Scheduled") }} 
                            @else
                                {{ __("Late") }}
                            @endif
                        @else
                            {{ __("Completed") }}
                        @endif
                    </p>
                    <p>
                        <span class="opacity-50">Time:</span>
                        {{ date("g:i A", strtotime($scheduleTime)) }}
                    </p>
                </div>

                <div class="p-3 min-h-40 rounded-lg border border-gray-200 bg-white">
                    <p class="text-xs opacity-50">Note</p>
                    @if ($note == '')
                        <p class="opacity-50">You have no note.</p>
                    @else
                        <p>{{ $note }}</p>
                    @endif
                </div>
            </div>
            
            <div class="p-5 border-t border-gray-200">
                <div class="flex justify-between items-center gap-3">
                    <div class="flex items-center gap-3">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-30 21.5-51t50.5-21h216l96 96h312q30 0 51 21t21 51v336q0 29-21 50.5T792-192H168Z"/></svg>
                        @if ($patientId)    
                            <a wire:navigate href="{{ route('record', ['id' => $patientId]) }}" class="text-sm opacity-50 hover:opacity-100"><span class="capitalize">{{ $firstName }}</span>'s records</a>
                        @endif
                    </div>
                    @if ($status == 'scheduled')
                        <x-primary-button type="button" wire:click="completeConfirm" type="button" class="flex items-center gap-3">
                            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m400-416 236-236q11-11 28-11t28 11q11 11 11 28t-11 28L428-332q-12 12-28 12t-28-12L268-436q-11-11-11-28t11-28q11-11 28-11t28 11l76 76Z"/></svg>
                            {{ __('Record Complete') }}
                        </x-primary-button>
                    @endif
                </div>
            </div>

        </form>
    </x-modal>  

    <!-- Complete Confirm -->
     <x-modal-confirmation name="{{ $modalConfirm }}">
        <div class="p-5 flex gap-5 items-center border-b border-gray-200">
            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-280q17 0 28.5-11.5T520-320v-160q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480v160q0 17 11.5 28.5T480-280Zm0-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
            <p>Record Completed?</p>
        </div>

        <div class="p-5">
            <p>Are you sure <span class="capitalize">{{ $firstName }}'s</span> <span class="capitalize border-b-2 border-gray-200">{{ $purpose }}</span> was already completed?</p>
        </div>

        <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
            <x-secondary-button x-on:click="show = false">No, cancel</x-secondary-button>
            <x-primary-button x-on:click="show = false" wire:click="update({{ $recordId }})">Yes, done!</x-primary-button>
        </div>
    </x-modal-confirmation>
</div>