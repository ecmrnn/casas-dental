@php
    $counter = 0;
    $recordCounter = 0;
    $maxDateRecord = 2;
    $prevYear;
@endphp

<div>
    <x-slot name="header">
        {{ __('Calendar') }}
    </x-slot>
    
    <div class="grid grid-cols-1 md:gap-10 xl:grid-cols-3" id="content">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif
    
        {{-- Dashboard Content --}}
        <section class="p-5 pt-0 flex flex-col md:p-0 w-full xl:col-span-2">
            <div class="p-5 rounded-lg border border-gray-200 bg-white flex-grow">
                <div class="mb-5 flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-40q0-17 11.5-28.5T280-880q17 0 28.5 11.5T320-840v40h320v-40q0-17 11.5-28.5T680-880q17 0 28.5 11.5T720-840v40h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
                    <p>{{ $monthName . " " . $year }}</p>
                </div>
            
                {{-- Days --}}
                <div class="grid grid-cols-7">
                    <p class="py-2 bg-primary/5 text-center rounded-s-lg">Sun</p>
                    <p class="py-2 bg-primary/5 text-center">Mon</p>
                    <p class="py-2 bg-primary/5 text-center">Tues</p>
                    <p class="py-2 bg-primary/5 text-center">Wed</p>
                    <p class="py-2 bg-primary/5 text-center">Thur</p>
                    <p class="py-2 bg-primary/5 text-center">Fri</p>
                    <p class="py-2 bg-primary/5 text-center rounded-e-lg">Sat</p>
                </div>
            
                {{-- Dates --}}
                <div class="grid grid-cols-7 mt-1 gap-1">
                    @foreach ($days  as $day)
                        @php
                            $counter = 0;
                        @endphp
            
                        {{-- Date --}}
                        <div key="{{ $day['id'] }}" class="relative">
                            <button
                                wire:click="showDate('{{ $day['date'] }}')" 
                                class="p-2 w-full rounded-lg border border-gray-200 relative min-h-28  hover:bg-gray-50
                                @if(date('Y-m-j', strtotime($day['date'])) == date('Y-m-j')) bg-gray-100 @endif
                                @if(date('F j, Y', strtotime($day['date'])) == $selectedDate) outline-1 outline outline-primary @endif
                                ">
                
                                <div class="absolute top-2 left-2 
                                    @if(date('Y-m', strtotime($day['date'])) !== date('Y-m')) text-primary/20 @endif)">
                                    {{ $day['day'] }}
                                </div>
                            </button>

                            {{-- Records this date --}}
                            <div class="w-full absolute bottom-0 left-0 p-2 space-y-1">
                                @foreach ($records as $record)
                                    @if ($record->schedule_date == $day['date'])
                                        @php
                                            $counter++;
                                        @endphp
                                        @if ($counter <= $maxDateRecord)
                                            <button key="{{ $record->id }}" class="py-1 block w-full bg-primary rounded-md hover:bg-primary/90">
                                                <p class="text-white text-center text-xs capitalize line-clamp-1">{{ $record->first_name . ", " . substr($record->last_name, 0, 1) . "." }}</p>
                                            </button>    
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                            @if ($counter > $maxDateRecord)
                                <p class="absolute top-2 right-2 text-primary/50 text-xs uppercase">{{ "+ " . $counter - $maxDateRecord . " more"}}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Navigating Calendar --}}
                <div class="mt-1 grid grid-cols-3 gap-1">
            
                    {{-- if the current month is January --}}
                    @if ($prevMonth == 12)
                        <x-secondary-button wire:model="year" wire:click="navigateMonth({{ $prevMonth }}, {{ $year - 1 }})">
                            <div class="flex items-center gap-3">
                                <svg class="fill-primary hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="m438-480 164 164q11 11 11 25.5T602-265q-11 11-25.5 11t-25.838-11.338L361-455q-5-5.4-7.5-11.7-2.5-6.3-2.5-13.5t2.5-13.5Q356-500 361-505l189.662-189.662Q562-706 576.5-706q14.5 0 25.5 11t11 25.5q0 14.5-11 25.5L438-480Z"/></svg>
                                {{ $prevMonthName }}
                            </div>
                        </x-secondary-button>
                    @else    
                        <x-secondary-button wire:model="year" wire:click="navigateMonth({{ $prevMonth }}, {{ $year }})">
                            <div class="flex items-center gap-3">
                                <svg class="fill-primary hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="m438-480 164 164q11 11 11 25.5T602-265q-11 11-25.5 11t-25.838-11.338L361-455q-5-5.4-7.5-11.7-2.5-6.3-2.5-13.5t2.5-13.5Q356-500 361-505l189.662-189.662Q562-706 576.5-706q14.5 0 25.5 11t11 25.5q0 14.5-11 25.5L438-480Z"/></svg>
                                {{ $prevMonthName }}
                            </div>
                        </x-secondary-button>
                    @endif
            
                    <x-secondary-button wire:click="today">
                        <div class="flex items-center gap-3">
                            Today
                        </div>
                    </x-secondary-button>
            
                    {{-- if the current month is December --}}
                    @if ($nextMonth == 1)
                        <x-secondary-button wire:model="year" wire:click="navigateMonth({{ $nextMonth }}, {{ $year + 1 }})">
                            <div class="flex items-center gap-3">
                                {{ $nextMonthName }}
                                <svg class="fill-primary rotate-180 hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="m438-480 164 164q11 11 11 25.5T602-265q-11 11-25.5 11t-25.838-11.338L361-455q-5-5.4-7.5-11.7-2.5-6.3-2.5-13.5t2.5-13.5Q356-500 361-505l189.662-189.662Q562-706 576.5-706q14.5 0 25.5 11t11 25.5q0 14.5-11 25.5L438-480Z"/></svg>
                            </div>
                        </x-secondary-button>
                    @else
                        <x-secondary-button wire:click="navigateMonth({{ $nextMonth }}, {{ $year }})">
                            <div class="flex items-center gap-3">
                                {{ $nextMonthName }}
                                <svg class="fill-primary rotate-180 hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="m438-480 164 164q11 11 11 25.5T602-265q-11 11-25.5 11t-25.838-11.338L361-455q-5-5.4-7.5-11.7-2.5-6.3-2.5-13.5t2.5-13.5Q356-500 361-505l189.662-189.662Q562-706 576.5-706q14.5 0 25.5 11t11 25.5q0 14.5-11 25.5L438-480Z"/></svg>
                            </div>
                        </x-secondary-button>
                    @endif
                </div>    
            </div>
        </section>
        
        <aside class="min-h-[500px] w-full p-5 md:rounded-lg border border-gray-200 bg-white">
            <div class="mb-5 flex items-center gap-5">
                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-280q-33 0-56.5-23.5T120-360v-240q0-33 23.5-56.5T200-680h560q33 0 56.5 23.5T840-600v240q0 33-23.5 56.5T760-280H200Zm0-80h560v-240H200v240Zm-80-400v-80h720v80H120Zm0 640v-80h720v80H120Zm80-480v240-240Z"/></svg>
                <p>{{ $selectedDate }}</p>
            </div>

            {{-- Records --}}
            <div>
                <div class="relative">
                    <div class="p-2 px-4 mb-1 rounded-lg bg-primary/5 flex justify-between">
                        <p>Time</p>
                        <p>Patient &#47; Procedure</p>
                    </div>

                    <div class="space-y-1">
                        @foreach ($records as $record)
                            @if (date('F j, Y', strtotime($record->schedule_date)) == $selectedDate)
                                @php
                                    $recordCounter++;
                                @endphp
                                <div class="pl-5 border border-gray-200 rounded-lg flex justify-between items-center">
                                    <p>{{ date('g:i A', strtotime($record->schedule_time)) }}</p>
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-right leading-none capitalize">{{ $record->first_name . " " . $record->last_name}}</p>
                                            <p class="text-xs text-right capitalize">{{ $record->purpose }}</p>
                                        </div>
                                        <livewire:patients.view-patient-record :record="$record" :isIcon="true" />
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @if ($recordCounter == 0)
                        <div class="w-full p-10 rounded-lg border bg-white border-gray-200 absolute top-0">
                            <p class="text-center text-7xl">🛋️</p>
                            <p class="mt-2 text-center poppins-bold text-2xl leading-none">Rest well~</p>
                            <p class="text-center opacity-50">No scheduled patients</p>
                        </div>
                    @endif
                </div>
            </div>
        </aside>    
    </div>
</div>