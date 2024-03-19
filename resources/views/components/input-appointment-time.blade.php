@props([
    'time' => '',
])

<button type="button" for="scheduleTime" class="w-full hover:bg-primary/5 rounded-lg">
    <div class="py-2 px-3 rounded-lg border border-gray-200 text-center">
        {{ $time }}
    </div>
    <input type="radio" value="{{ $time }}" name="scheduleTime" id="scheduleTime" class="sr-only">
</button>