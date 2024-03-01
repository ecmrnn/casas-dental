<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white sticky top-0 border-b border-gray-200 sm:border-0">
    <!-- Primary Navigation Menu -->
    <div>
        <div class="h-auto sm:h-screen flex sm:flex-col items-center justify-between border-r border-gray-200">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" wire:navigate class="sm:min-w-72 flex items-center sm:border-b border-gray-200">
                <x-application-logo />
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden sm:block min-w-72 h-full">
                <!-- Navigation Links -->
                <div class="p-5 flex flex-col">

                    <p class="mb-5 opacity-50 uppercase text-sm">Main Menu</p>
                    <div class="space-y-1">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M528-660v-121q0-14.875 10.062-24.938Q548.125-816 563-816h217.588Q796-816 806-805.938q10 10.063 10 24.938v121q0 15.3-10.062 25.65Q795.875-624 781-624H563.412Q548-624 538-634.35 528-644.7 528-660ZM144-467v-314q0-14.875 10.391-24.938Q164.782-816 180.143-816H397q14 0 24.5 10.062Q432-795.875 432-781v314q0 14-10.5 24.5T397-432H180.143q-15.361 0-25.752-10.5Q144-453 144-467Zm384 287v-312q0-15.3 10.062-25.65Q548.125-528 563-528h217.588Q796-528 806-517.65q10 10.35 10 25.65v312q0 15.3-10.062 25.65Q795.875-144 781-144H563.412Q548-144 538-154.35 528-164.7 528-180Zm-384 0v-122q0-14.875 10.391-24.938Q164.782-337 180.143-337H397q14 0 24.5 10.062Q432-316.875 432-302v122q0 15.3-10.5 25.65Q411-144 397-144H180.143q-15.361 0-25.752-10.35Q144-164.7 144-180Zm72-324h144v-240H216v240Zm384 288h144v-240H600v240Zm0-479h144v-49H600v49ZM216-216h144v-49H216v49Zm144-288Zm240-191Zm0 239ZM360-265Z"/></svg>
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-29.7 21.5-50.85Q139-768 168-768h185.643q14.349 0 27.353 5Q394-758 405-747l75 75h312q29.7 0 50.85 21.15Q864-629.7 864-600v336q0 29-21.15 50.5T792-192H168Zm0-72h624v-336H450l-96-96H168v432Zm0 0v-432 432Z"/></svg>
                            {{ __('Records') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M216-96q-29.7 0-50.85-21.5Q144-139 144-168v-528q0-29 21.15-50.5T216-768h72v-60q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q339-864 349.5-853.65 360-843.3 360-828v60h240v-60q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q651-864 661.5-853.65 672-843.3 672-828v60h72q29.7 0 50.85 21.5Q816-725 816-696v528q0 29-21.15 50.5T744-96H216Zm0-72h528v-360H216v360Zm0-432h528v-96H216v96Zm0 0v-96 96Z"/></svg>
                            {{ __('Schedule') }}
                        </x-nav-link>
                    </div>

                    <p class="my-5 opacity-50 uppercase text-sm">Account Settings</p>
                    <div class="space-y-1">
                        <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate class="flex items-center gap-5">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M360.113-312Q340-312 326-325.887q-14-13.888-14-34Q312-380 325.887-394q13.888-14 34-14Q380-408 394-394.113q14 13.888 14 34Q408-340 394.113-326q-13.888 14-34 14Zm240 0Q580-312 566-325.887q-14-13.888-14-34Q552-380 565.887-394q13.888-14 34-14Q620-408 634-394.113q14 13.888 14 34Q648-340 634.113-326q-13.888 14-34 14ZM480-72q130 0 221-91t91-221q0-25-5-54t-13.276-50Q752-483 738.5-481.5 725-480 702-480q-91 0-169-32.5T398-610q-38 77-93.5 128T168-404v20q0 130 91 221t221 91Zm-56-619.194Q469-628 538.5-590T702-552q11 0 19-.5t19-2.5q-51-71-115.5-106T480-696q-14 0-28 1.5t-28 3.306ZM187-489q49-27 88.5-67T341-663q-59 32-95.5 72.5T187-489Zm237-201Zm-83 27Zm-200 99q26-51 66.96-91.62Q248.92-696.239 300-723q-15-32-43.987-50.5Q227.026-792 192-792q-50.42 0-85.21 34.79Q72-722.42 72-672q0 35.026 18.5 64.013Q109-579 141-564ZM480.276 0Q401 0 331-30q-70-30-122.5-82.5T126-234.812Q96-304.624 96-384q0-28.663 4.5-56.831Q105-469 113-497q-52-23-82.5-70.301Q0-614.601 0-672q0-80.08 55.96-136.04Q111.92-864 192-864q56.732 0 104.366 30.5T367-751q28-9 56.169-13 28.168-4 56.831-4 80 0 149.5 30t122 82.5Q804-603 834-533.276q30 69.725 30 149Q864-305 834-235q-30 70-82.5 122.5T629.276-30q-69.725 30-149 30ZM211-658Z"/></svg>
                            {{ __('Profile') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M384-337q-99 0-169.5-70T144-576q0-23 3.5-44.5T161-663q4-8 10.779-13.5t14.913-7.5q8.135-2 16.721.5Q212-681 219-674l107 107 70-70-106-106q-7.111-7.111-9.556-15.556Q278-767 280-775q2-8 7.5-15.5T302-802q20-8 40.667-11 20.666-3 41.333-3 100 0 170 71t70 170.187q0 22.813-4.5 42.313Q615-513 607-493l161 160q29 29 29 69.225 0 40.226-29 68Q739-168 699.5-168.5T632-197L475-354q-20 8-43.5 12.5T384-337Zm0-72q17 0 47-7t56-28l196 196q7 7 16.5 7t17.5-7.5q8-7.5 8-17t-8-17.5L520-478q20-24 26-52.5t6-44.5q0-66.846-47.5-116.423T390-744l82 81q11 11.182 11 26.091t-11.289 26.12L351.289-491.211Q340-480 325.818-480T301-491l-85-85q0 69 49.5 118T384-409Zm88-82Z"/></svg>
                            {{ __('Settings') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="p-3 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md border border-transparent hover:border-gray-200 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="py-2 border-t border-gray-200">

            <p class="px-5 py-2 opacity-50 uppercase text-sm">Main Menu</p>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M528-660v-121q0-14.875 10.062-24.938Q548.125-816 563-816h217.588Q796-816 806-805.938q10 10.063 10 24.938v121q0 15.3-10.062 25.65Q795.875-624 781-624H563.412Q548-624 538-634.35 528-644.7 528-660ZM144-467v-314q0-14.875 10.391-24.938Q164.782-816 180.143-816H397q14 0 24.5 10.062Q432-795.875 432-781v314q0 14-10.5 24.5T397-432H180.143q-15.361 0-25.752-10.5Q144-453 144-467Zm384 287v-312q0-15.3 10.062-25.65Q548.125-528 563-528h217.588Q796-528 806-517.65q10 10.35 10 25.65v312q0 15.3-10.062 25.65Q795.875-144 781-144H563.412Q548-144 538-154.35 528-164.7 528-180Zm-384 0v-122q0-14.875 10.391-24.938Q164.782-337 180.143-337H397q14 0 24.5 10.062Q432-316.875 432-302v122q0 15.3-10.5 25.65Q411-144 397-144H180.143q-15.361 0-25.752-10.35Q144-164.7 144-180Zm72-324h144v-240H216v240Zm384 288h144v-240H600v240Zm0-479h144v-49H600v49ZM216-216h144v-49H216v49Zm144-288Zm240-191Zm0 239ZM360-265Z"/></svg>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-29.7 21.5-50.85Q139-768 168-768h185.643q14.349 0 27.353 5Q394-758 405-747l75 75h312q29.7 0 50.85 21.15Q864-629.7 864-600v336q0 29-21.15 50.5T792-192H168Zm0-72h624v-336H450l-96-96H168v432Zm0 0v-432 432Z"/></svg>
                    {{ __('Records') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M216-96q-29.7 0-50.85-21.5Q144-139 144-168v-528q0-29 21.15-50.5T216-768h72v-60q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q339-864 349.5-853.65 360-843.3 360-828v60h240v-60q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q651-864 661.5-853.65 672-843.3 672-828v60h72q29.7 0 50.85 21.5Q816-725 816-696v528q0 29-21.15 50.5T744-96H216Zm0-72h528v-360H216v360Zm0-432h528v-96H216v96Zm0 0v-96 96Z"/></svg>
                    {{ __('Schedule') }}
                </x-responsive-nav-link>
            </div>
            
            <p class="px-5 py-2 opacity-50 uppercase text-sm">Account Settings</p>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate class="flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M360.113-312Q340-312 326-325.887q-14-13.888-14-34Q312-380 325.887-394q13.888-14 34-14Q380-408 394-394.113q14 13.888 14 34Q408-340 394.113-326q-13.888 14-34 14Zm240 0Q580-312 566-325.887q-14-13.888-14-34Q552-380 565.887-394q13.888-14 34-14Q620-408 634-394.113q14 13.888 14 34Q648-340 634.113-326q-13.888 14-34 14ZM480-72q130 0 221-91t91-221q0-25-5-54t-13.276-50Q752-483 738.5-481.5 725-480 702-480q-91 0-169-32.5T398-610q-38 77-93.5 128T168-404v20q0 130 91 221t221 91Zm-56-619.194Q469-628 538.5-590T702-552q11 0 19-.5t19-2.5q-51-71-115.5-106T480-696q-14 0-28 1.5t-28 3.306ZM187-489q49-27 88.5-67T341-663q-59 32-95.5 72.5T187-489Zm237-201Zm-83 27Zm-200 99q26-51 66.96-91.62Q248.92-696.239 300-723q-15-32-43.987-50.5Q227.026-792 192-792q-50.42 0-85.21 34.79Q72-722.42 72-672q0 35.026 18.5 64.013Q109-579 141-564ZM480.276 0Q401 0 331-30q-70-30-122.5-82.5T126-234.812Q96-304.624 96-384q0-28.663 4.5-56.831Q105-469 113-497q-52-23-82.5-70.301Q0-614.601 0-672q0-80.08 55.96-136.04Q111.92-864 192-864q56.732 0 104.366 30.5T367-751q28-9 56.169-13 28.168-4 56.831-4 80 0 149.5 30t122 82.5Q804-603 834-533.276q30 69.725 30 149Q864-305 834-235q-30 70-82.5 122.5T629.276-30q-69.725 30-149 30ZM211-658Z"/></svg>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="flex items-center gap-5">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M216-144q-29.7 0-50.85-21.15Q144-186.3 144-216v-528q0-29.7 21.15-50.85Q186.3-816 216-816h228q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q480-765 469.65-754.5 459.3-744 444-744H216v528h228q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q480-165 469.65-154.5 459.3-144 444-144H216Zm462-300H419.963q-15.284 0-25.624-10.289Q384-464.579 384-479.789 384-495 394.339-505.5q10.34-10.5 25.624-10.5H678l-56-56q-11-11-11-25.571 0-14.572 11-25.5Q633-634 647.5-634t25.5 11l118 118q11 10.636 11 24.818Q802-466 791-455L673-337q-11 11-25 10.5T622.522-338Q612-349 612-363.5t11-25.5l55-55Z"/></svg>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
