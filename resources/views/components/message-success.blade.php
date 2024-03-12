@props(['message' => ''])

<button
    x-data="{ open: true }"
    x-on:click="open = false"
    x-show="open"
    x-transition
    x-init="setTimeout(() => open = false, 5000)"
    class="p-2 pr-5 rounded-lg bg-white border border-green-500 fixed right-3 top-3 sm:right-5 sm:top-5 flex items-center gap-5 overflow-hidden z-50">

    <div class="w-8 aspect-square rounded-full bg-green-500 grid place-items-center">
        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m400-416 236-236q11-11 28-11t28 11q11 11 11 28t-11 28L428-332q-12 12-28 12t-28-12L268-436q-11-11-11-28t11-28q11-11 28-11t28 11l76 76Z"/></svg>
    </div>
    
    <p class="text-sm">{{ $message }}</p>
</button>