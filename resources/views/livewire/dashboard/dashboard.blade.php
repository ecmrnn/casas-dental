<div>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    
    <div class="grid grid-cols-1 md:gap-10 xl:grid-cols-3">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif

        {{-- Dashboard Content --}}
        <section class="p-5 flex flex-col md:p-0 w-full xl:col-span-2">

            {{-- Cards --}}
            <div class="w-full mb-5 gap-2 grid grid-cols-3 xl:gap-10">
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Zm80 0h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Total <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if ($patients == '0')
                                {{ __('...') }}
                            @else
                                {{ sprintf('%03d', $patients) }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="m702-593 141-142q12-12 28.5-12t28.5 12q12 12 12 28.5T900-678L730-508q-12 12-28 12t-28-12l-85-85q-12-12-12-28.5t12-28.5q12-12 28-12t28 12l57 57ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 260Zm0-340Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Patients <br class="sm:hidden"> Today</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if (count($scheduled) == 0)
                                {{ __('...') }}
                            @else
                                {{ sprintf('%03d', count($scheduled)) }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M800-520q-17 0-28.5-11.5T760-560q0-17 11.5-28.5T800-600q17 0 28.5 11.5T840-560q0 17-11.5 28.5T800-520Zm0-120q-17 0-28.5-11.5T760-680v-120q0-17 11.5-28.5T800-840q17 0 28.5 11.5T840-800v120q0 17-11.5 28.5T800-640ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Late <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if (count($late) == 0)
                                {{ __('...') }}
                            @else
                            {{ sprintf('%03d', count($late)) }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Recent Patients --}}
            <div class="p-5 rounded-lg border border-gray-200 bg-white flex-grow">
                <div class="mb-5 flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-17 0-28.5-11.5T200-120v-280q0-17 11.5-28.5T240-440h40v-184l-80-79q-23-23-23-57t23-57l75-75q12-12 28.5-12t28.5 12q12 12 12 28.5T332-835l-76 75 81 80q11 11 17 26t6 31v183h40q17 0 28.5 11.5T440-400v280q0 17-11.5 28.5T400-80H240Zm320 0q-17 0-28.5-11.5T520-120v-280q0-17 11.5-28.5T560-440h40v-125q-52-14-86-56t-34-99q0-66 47-113t113-47q66 0 113 47t47 113q0 57-34 99t-86 56v125h40q17 0 28.5 11.5T760-400v280q0 17-11.5 28.5T720-80H560Zm80-560q33 0 56.5-23.5T720-720q0-33-23.5-56.5T640-800q-33 0-56.5 23.5T560-720q0 33 23.5 56.5T640-640ZM280-160h80v-200h-80v200Zm320 0h80v-200h-80v200Zm-320 0h80-80Zm320 0h80-80Z"/></svg>
                    <p>Patients Today</p>
                </div>

                {{-- Table of Recent Patients --}}
                @if (count($scheduled) == 0)
                    <div class="w-full p-10 rounded-lg border border-gray-200">
                        <p class="text-center text-7xl">🛋️</p>
                        <p class="mt-2 text-center poppins-bold text-2xl leading-none">Rest well~</p>
                        <p class="text-center opacity-50">No scheduled patients</p>
                    </div>
                @else
                    {{-- Desktop --}}
                    <div class="hidden md:block">
                        <x-table>
                            <x-slot name="header">
                                <th class="w-[24px] text-left bg-primary/5 rounded-s-lg"></th>
                                <th class="py-3 text-left bg-primary/5">Time</th>
                                <th class="py-3 text-left bg-primary/5">Patient name</th>
                                <th class="py-3 text-left bg-primary/5">Purpose</th>
                                <th class="py-3 text-left bg-primary/5">Your note</th>
                                <th class="py-3 text-left bg-primary/5 rounded-e-lg"></th>
                            </x-slot>
    
                            <tbody>
                                @foreach ($scheduled as $record)
                                    <tr key="{{ $record->id }}">
                                        <td class="border-y border-l rounded-s-lg border-gray-200">
                                            @if ($record->status !== 'completed')
                                                @if ($record->status == 'scheduled')
                                                    @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                                        <div class="w-[10px] m-4 aspect-square rounded-full bg-orange-400">
                                                        </div>
                                                    @else
                                                        <div class="w-[10px] m-4 aspect-square rounded-full bg-red-500">
                                                        </div>
                                                    @endif
                                                @endif
                                            @else
                                                <div class="w-[10px] m-4 aspect-square rounded-full bg-green-400">
                                                </div>
                                            @endif
                                        </td>
                                        <td class="border-y border-gray-200 capitalize">{{ date('h:i A', strtotime($record->schedule_time)) }}</td>
                                        <td class="border-y border-gray-200 capitalize">{{ $record->first_name . " " . $record->last_name }}</td>
                                        <td class="border-y border-gray-200 capitalize">{{ $record->purpose }}</td>
                                        <td class="border-y border-gray-200">
                                            @if ($record->note)
                                                {{ $record->note }}
                                            @else
                                                <p class="opacity-20">No note</p>
                                            @endif
                                        </td>
                                        <td class="py-2 px-5 border-y border-r border-gray-200 rounded-e-lg text-right">
                                            <button wire:click="viewRecord({{ $record->rid }}, '{{ $record->first_name }}', {{ $record->id }})" class="px-5 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm">
                                                View Schedule
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    </div>

                    {{-- Mobile --}}
                    <div class="md:hidden space-y-2">
                        @foreach ($scheduled as $record)
                            <div class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                                <button wire:click="viewRecord({{ $record->rid }}, '{{ $record->first_name }}', {{ $record->id }})" class="w-full text-left flex items-center pr-4 flex-grow">
                                    @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                        <div class="w-[12px] m-5 aspect-square rounded-full bg-orange-400">
                                        </div>
                                    @else
                                        <div class="w-[12px] m-5 aspect-square rounded-full bg-red-500">
                                        </div>
                                    @endif
                
                                    <div>
                                        <p class="leading-none capitalize">{{ $record->first_name . " " . $record->last_name }}</p>
                                        <p class="leading-none text-xs">
                                            <span class="capitalize">{{ $record->purpose }}</span> at <span>{{ date("h:i A", strtotime($record->schedule_time)) }}</span>
                                        </p>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                        {{ $scheduled->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>

        
            {{-- View Record --}}
            <x-modal name="view-record-modal">
                <form autocomplete="off">
                    <div x-data class="flex items-center justify-between border-b border-gray-200">
                        <div class="pl-5 sm:p-5 flex items-center gap-3">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                            <p class="capitalize poppins-bold">Schedule Details</p>
                        </div>
                        <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                        </button>
                    </div>  

                    {{-- Patient information --}}
                    <div class="p-5 rounded-lg space-y-2 border-gray-200 bg-gray-50/90">
                        <div class="p-3 rounded-lg border border-gray-200 bg-white">
                            <p class="text-xs opacity-50">Purpose</p>
                            <h3 class="poppins-bold text-xl leading-none capitalize">{{ $purpose }}</h3>
                        </div>
                        <div class="p-3 rounded-lg border border-gray-200 bg-white">
                            
                            <p class="capitalize leading-none">
                                <span class="opacity-50">Status:</span>
                                @if ($scheduleDate . " " . $scheduleTime > date('Y-m-d H:i:s'))
                                    {{ __("Scheduled") }} 
                                @else
                                    {{ __("Late") }}
                                @endif
                            </p>
                            <p>
                                <span class="opacity-50">Time:</span>
                                {{ date("h:i A", strtotime($scheduleTime)) }}
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
                            <x-primary-button type="button" wire:click="completeConfirm" type="button" class="flex items-center gap-3">
                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m400-416 236-236q11-11 28-11t28 11q11 11 11 28t-11 28L428-332q-12 12-28 12t-28-12L268-436q-11-11-11-28t11-28q11-11 28-11t28 11l76 76Z"/></svg>
                                {{ __('Record Complete') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </x-modal>  

             {{-- Complete Confirm --}}
             <x-modal-confirmation name="complete-confirm-record">
                <div class="p-5 flex gap-5 items-center border-b border-gray-200">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M78-99q-11.483 0-19.894-5.625Q49.696-110.25 46-118q-5.167-6.6-5.583-16.8Q40-145 46-154l403-695q5-9 13.5-13.5T480-867q9 0 17.5 4.5T512-849l403 695q5 9 4.583 19.2-.416 10.2-4.583 16.8-5.044 7.4-13.522 13.2Q893-99 883-99H78Zm63-73h678L480-757 141-172Zm343.86-52q15.14 0 25.64-10.658t10.5-25.5Q521-275 510.325-286q-10.676-11-25.816-11-15.141 0-25.825 10.95Q448-275.099 448-259.825q0 14.85 10.86 25.337Q469.719-224 484.86-224Zm0-122q15.14 0 25.64-10.625T521-383v-153q0-14.775-10.675-25.388Q499.649-572 484.509-572q-15.141 0-25.825 10.612Q448-550.775 448-536v153q0 15.75 10.86 26.375Q469.719-346 484.86-346ZM480-465Z"/></svg>
                    <p>Record Completed?</p>
                </div>

                <div class="p-5">
                    <p>Are you sure <span class="capitalize">{{ $firstName }}'s</span> <span class="capitalize border-b-2 border-gray-200">{{ $purpose }}</span> was already completed?</p>
                </div>

                <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                    <x-secondary-button x-on:click="show = false">No, cancel</x-secondary-button>
                    <x-primary-button x-on:click="show = false" wire:click="complete({{ $recordId }})">Yes, done!</x-primary-button>
                </div>
            </x-modal-confirmation>
        </section>

        {{-- Tasks --}}
        @livewire('dashboard.tasks')
    </div>
</div>
