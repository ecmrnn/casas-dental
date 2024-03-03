<div class="p-5 md:p-0">
    <x-slot name="header">
        {{ __('Records') }}
    </x-slot>

    {{-- Records Content --}}
    <section class="p-5 rounded-lg border border-gray-200 bg-white">
        <div class="flex items-center gap-5">
            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M640-400q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM400-160v-76q0-21 10-40t28-30q45-27 95.5-40.5T640-360q56 0 106.5 13.5T842-306q18 11 28 30t10 40v76H400Zm86-80h308q-35-20-74-30t-80-10q-41 0-80 10t-74 30Zm154-240q17 0 28.5-11.5T680-520q0-17-11.5-28.5T640-560q-17 0-28.5 11.5T600-520q0 17 11.5 28.5T640-480Zm0-40Zm0 280ZM120-400v-80h320v80H120Zm0-320v-80h480v80H120Zm324 160H120v-80h360q-14 17-22.5 37T444-560Z"/></svg>
            <p>My Patients</p>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden md:block">
            <x-table>
                <x-slot name="header">
                    <th class="pl-5 py-3 text-left bg-green-50 rounded-s-lg"></th>
                    <th class="py-3 md:w-1/3 text-left bg-green-50">Patient Name</th>
                    <th class="py-3 text-left bg-green-50">Contact Number</th>
                    <th class="py-3 text-left bg-green-50">Date Added</th>
                    <th class="py-3 text-left bg-green-50 rounded-e-lg"></th>
                </x-slot>
        
                <tbody>
                    <tr>
                        <td class="pl-2 border-y border-l rounded-s-lg border-gray-200">
                            <button class="w-[50px] h-[40px] grid place-items-center rounded-lg border border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-29.7 21.5-50.85Q139-768 168-768h185.643q14.349 0 27.353 5Q394-758 405-747l75 75h312q29.7 0 50.85 21.15Q864-629.7 864-600v336q0 29-21.15 50.5T792-192H168Zm0-72h624v-336H450l-96-96H168v432Zm0 0v-432 432Zm312-24h288v-21q0-29-44-52t-100.5-23q-56.5 0-100 22.5T480-309v21Zm144.212-144Q654-432 675-453.212q21-21.213 21-51Q696-534 674.788-555q-21.213-21-51-21Q594-576 573-554.788q-21 21.213-21 51Q552-474 573.212-453q21.213 21 51 21Z"/></svg>
                            </button>
                        </td>
                        <td class="border-y border-gray-200">Juan Dela Cruz</td>
                        <td class="border-y border-gray-200">0926 235 5376</td>
                        <td class="border-y border-gray-200">March 4, 2024</td>
                        <td class="py-2 px-5 border-y border-r border-gray-200 rounded-e-lg text-right">
                            <button class="px-5 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                                View Record
                            </button>
                        </td>
                    </tr>
                </tbody>
            </x-table>
        </div>

        {{-- Mobile List --}}
        <div class="md:hidden mt-5">
            <div class="flex items-center rounded-lg border border-gray-200">
                <a wire:navigate href="" class="flex items-center pr-4 flex-grow">
                    <div class="p-4">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-30 21.5-51t50.5-21h216l96 96h312q30 0 51 21t21 51v336q0 29-21 50.5T792-192H168Z"/></svg>
                    </div>
                    <div>
                        <p class="leading-none">Juan Dela Cruz</p>
                        <p class="leading-none text-xs opacity-50">0926 235 5376</p>
                    </div>
                </a>

                <button wire:click="action({{1}})" class="p-2 m-2 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                </button>

                {{-- Action Modal --}}
                <x-modal name="action-modal">
                    <div x-data class="flex items-center justify-between border-b border-gray-200">
                        <div class="pl-5 flex items-center gap-3">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Z"/></svg>
                            <p>Juan Dela Cruz</p>
                        </div>
                        <button x-on:click="show = false" class="p-2 m-3 border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                        </button>
                    </div>

                    {{-- Patient information --}}
                    <div class="p-5 space-y-2 border-b border-gray-200 bg-gray-50/90">
                        <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                            <x-input-label for="firstName" :value="__('First Name')" />
                            <x-text-input wire:model="firstName" id="firstName" class="block w-full focus-visible:outline-none" type="text" name="firstName" placeholder="Juan" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                        </div>
                        <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                            <x-input-label for="lastName" :value="__('Last Name')" />
                            <x-text-input wire:model="lastName" id="lastName" class="block w-full focus-visible:outline-none" type="text" name="lastName" placeholder="Dela Cruz" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                        </div>
                        <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                            <x-input-label for="contactNumber" :value="__('Contact Number')" />
                            <x-text-input wire:model="contactNumber" id="contactNumber" class="block w-full focus-visible:outline-none" type="text" name="contactNumber" placeholder="09xx xxx xxxx" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('contactNumber')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Actio buttons --}}
                    <div class="p-5 grid gap-5 grid-cols-2">
                        <x-secondary-button>Update Patient</x-secondary-button>
                        <x-danger-button>Remove Patient</x-danger-button>
                    </div>
                </x-modal>
            </div>
        </div>

    </section>
</div>