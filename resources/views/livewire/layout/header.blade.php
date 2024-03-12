<div 
    x-data="{ open: false }"
    class="flex items-center gap-5 relative">
    <div>
        <p class="poppins-bold leading-none text-xs text-right">Welcome Back,</p>
        <p class="poppins-bold leading-none text-right capitalize">Doc. {{ auth()->user()->name }}</p>
    </div>
    <button x-on:click="open = ! open" class="w-[50px] aspect-square rounded-lg bg-primary grid place-items-center">
        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-40q-23 0-46-3t-46-8Q300 14 194.5-4.5T33-117q-45-74-29-159t77-143v-3Q19-479 4-562.5T32-720q37-63 102-95.5T271-838q32-57 87.5-89.5T480-960q66 0 121.5 32.5T689-838q72-10 137 22.5T928-720q43 74 28 157.5T879-422v3q61 58 77 143t-29 159Q871-23 765.5-4.5T572-51q-23 5-46 8t-46 3ZM288-90q-32-18-61-41.5T174-183q-24-28-42.5-60.5T101-311q-20 36-20 76.5t21 75.5q29 48 81.5 68.5T288-90Zm384 0q52 20 104.5-.5T858-159q21-35 21-75.5T859-311q-12 35-30.5 67.5T786-183q-24 28-52.5 51.5T672-90Zm-192-30q134 0 227-93t93-227q0-29-4.5-55.5T782-547q-29 20-64 31t-73 11q-102 0-173.5-71.5T400-750q-104 26-172 112t-68 198q0 134 93 227t227 93ZM360-350q-21 0-35.5-14.5T310-400q0-21 14.5-35.5T360-450q21 0 35.5 14.5T410-400q0 21-14.5 35.5T360-350Zm240 0q-21 0-35.5-14.5T550-400q0-21 14.5-35.5T600-450q21 0 35.5 14.5T650-400q0 21-14.5 35.5T600-350ZM94-544q9-33 23-63.5t33-57.5q19-27 41.5-51t48.5-44q-43 0-79.5 21T102-681q-20 32-22 67t14 70Zm772 0q16-35 14-70t-22-67q-22-37-58.5-58T720-760q26 20 48.5 44t41.5 51q19 27 33 57.5t23 63.5Zm-221-41q29 0 54-9t46-25q-21-32-50-57.5T632-721q-34-19-72-29t-80-10v10q0 69 48 117t117 48Zm-54-239q-20-26-49-41t-62-15q-33 0-62 15t-49 41q26-8 54-12t57-4q29 0 57 4t54 12ZM150-665Zm660 0Zm-330-85Zm0-90ZM174-183Zm612 0Z"/></svg>
    </button>

    {{-- Logout --}}
    <div x-show="open" class="absolute -bottom-full right-0 bg-white rounded-lg">
        <button wire:click="logout" class="w-full">
            <div class="px-5 py-2 flex items-center gap-3 border border-gray-200 rounded-lg">
                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M216-144q-29.7 0-50.85-21.15Q144-186.3 144-216v-528q0-29.7 21.15-50.85Q186.3-816 216-816h228q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q480-765 469.65-754.5 459.3-744 444-744H216v528h228q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q480-165 469.65-154.5 459.3-144 444-144H216Zm462-300H419.963q-15.284 0-25.624-10.289Q384-464.579 384-479.789 384-495 394.339-505.5q10.34-10.5 25.624-10.5H678l-56-56q-11-11-11-25.571 0-14.572 11-25.5Q633-634 647.5-634t25.5 11l118 118q11 10.636 11 24.818Q802-466 791-455L673-337q-11 11-25 10.5T622.522-338Q612-349 612-363.5t11-25.5l55-55Z"/></svg>
                {{ __('Log Out') }}
            </div>
        </button>
    </div>
</div>