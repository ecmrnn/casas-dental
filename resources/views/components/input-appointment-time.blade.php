@props([
    'time' => '',
    'timeValue' => '',
    'scheduleTime' => '',
])

<button type="button" for="scheduleTime" class="w-full hover:bg-primary/5 rounded-lg
    @if ($scheduleTime == $timeValue) { bg-blue } @endif
    ">
    <div class="py-2 px-3 rounded-lg border border-gray-200 text-center text-nowrap">
        {{ $time }}
    </div>
    <input wire:model="scheduleTime" type="radio" value="{{ $timeValue }}" name="scheduleTime" id="scheduleTime" class="sr-only">
</button>