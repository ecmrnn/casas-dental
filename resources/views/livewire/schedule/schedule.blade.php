<div>
    <x-slot name="header">
        {{ __('Calendar') }}
    </x-slot>

    <div class="grid grid-cols-1 md:gap-10 xl:grid-cols-3">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif

        {{-- Dashboard Content --}}
        <section class="p-5 pt-0 flex flex-col md:p-0 w-full xl:col-span-2">
            {{-- Recent Patients --}}
            <div class="p-5 rounded-lg border border-gray-200 bg-white flex-grow">
                {{-- Table of Recent Patients --}}
                {{-- @if (true) --}}
                    {{-- <a wire:navigate href="{{ route('patients') }}" class="w-full block p-10 rounded-lg border border-gray-200">
                        <p class="text-center text-7xl">🤸</p>
                        <p class="mt-2 text-center poppins-bold text-2xl leading-none">No Patient Yet?</p>
                        <p class="text-center opacity-50">Click here to add one</p>
                    </a> --}}
                {{-- @else --}}
                    {{-- Desktop --}}
                    {{-- <div class="hidden md:block"> --}}
                    <div>
                       @livewire('schedule.calendar')
                    </div>

                    {{-- Mobile --}}
                    {{-- <div class="md:hidden space-y-2">
                        @foreach ($completed as $record)
                            <div class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                                <button wire:click="viewRecord()" class="w-full text-left flex items-center pr-4 flex-grow">
                                    <div class="w-[12px] m-5 aspect-square rounded-full bg-green-500">
                                    </div>
                
                                    <div>
                                        <p class="leading-none capitalize">{{ $record->first_name . " " . $record->last_name }}</p>
                                        <p class="text-xs">
                                            <span class="capitalize">{{ $record->purpose }}</span><span class="opacity-50"> at </span><span>{{ date("F d, Y", strtotime($record->schedule_date)) }}</span>
                                        </p>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div>  --}}
                {{-- @endif --}}
            </div>
        </section>

        {{-- Tasks --}}
        <aside class="min-h-[500px] w-full p-5 md:rounded-lg border border-gray-200 bg-white">
            <div class="mb-5 flex items-center gap-5">
                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-280q-33 0-56.5-23.5T120-360v-240q0-33 23.5-56.5T200-680h560q33 0 56.5 23.5T840-600v240q0 33-23.5 56.5T760-280H200Zm0-80h560v-240H200v240Zm-80-400v-80h720v80H120Zm0 640v-80h720v80H120Zm80-480v240-240Z"/></svg>
                <p>{{ $today }}</p>
            </div>
        </aside>
    </div>
</div>
