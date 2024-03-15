@php
    $counter = 0;
    $maxDateRecord = 2;
    $prevYear;
@endphp

<div>
    <div class="mb-5 flex items-center gap-5">
        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-40q0-17 11.5-28.5T280-880q17 0 28.5 11.5T320-840v40h320v-40q0-17 11.5-28.5T680-880q17 0 28.5 11.5T720-840v40h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-400Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-400Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-400ZM480-240q-17 0-28.5-11.5T440-280q0-17 11.5-28.5T480-320q17 0 28.5 11.5T520-280q0 17-11.5 28.5T480-240Zm-160 0q-17 0-28.5-11.5T280-280q0-17 11.5-28.5T320-320q17 0 28.5 11.5T360-280q0 17-11.5 28.5T320-240Zm320 0q-17 0-28.5-11.5T600-280q0-17 11.5-28.5T640-320q17 0 28.5 11.5T680-280q0 17-11.5 28.5T640-240Z"/></svg>
        <p>{{ $monthName . " " . $year }}</p>
    </div>

    {{-- Navigating Calendar --}}
    <div class="mb-1 grid grid-cols-3 gap-1">

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

            <div x-data key="{{ $day['id'] }}" class="relative">
                <button
                    x-on:click=""
                    class="p-2 w-full rounded-lg border border-gray-200 relative min-h-28 hover:bg-gray-50
                    @if(date('Y-m-d', strtotime($day['date'])) == date('Y-m-d')) bg-gray-100 @endif">
    
                    <div class="absolute top-2 left-2 
                        @if(date('Y-m', strtotime($day['date'])) !== date('Y-m')) text-primary/20 @endif)">
                        {{ $day['day'] }}
                    </div>
                </button>
                <div class="w-full absolute bottom-0 left-0 space-y-1 p-2">
                    @foreach ($records as $record)
                        @if ($record->schedule_date == $day['date'])
                            @php
                                $counter++;
                            @endphp
                            @if ($counter <= $maxDateRecord)
                                <button class="py-1 block w-full bg-primary rounded-md hover:bg-primary/90">
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
</div>
