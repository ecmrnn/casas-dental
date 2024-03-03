<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    
    <div class="grid grid-cols-1 gap-5 xl:grid-cols-3">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif

        {{-- Dashboard Content --}}
        <section class="p-5 md:p-0 w-full xl:col-span-2">

            {{-- Cards --}}
            <div class="w-full mb-10 gap-2 grid grid-cols-3 xl:gap-10">
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg  class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M251-120q-21.658 0-38.462-14.179Q195.734-148.358 192-170l-66-395q-2-14 6.488-24.5T155-600h650q14.024 0 22.512 10.5Q836-579 834-565l-66 395q-3.734 21.642-20.538 35.821Q730.658-120 709-120H251Zm-58-420 57 360h460l57-360H193Zm207 160h160q12.75 0 21.375-9T590-410.5q0-12.5-8.625-21T560-440H400q-12 0-21 8.625T370-410q0 12 9 21t21 9ZM240-660q-12 0-21-9t-9-21.5q0-12.5 9-21t21-8.5h480q12.75 0 21.375 8.625T750-690q0 12-8.625 21T720-660H240Zm80-120q-12 0-21-9t-9-21.5q0-12.5 9-21t21-8.5h320q12.75 0 21.375 8.625T670-810q0 12-8.625 21T640-780H320Zm-70 600h460-460Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Total <br class="sm:hidden"> Records</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">004</p>
                    </div>
                </div>
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M222-255q63-44 125-67.5T480-346q71 0 133.5 23.5T739-255q44-54 62.5-109T820-480q0-145-97.5-242.5T480-820q-145 0-242.5 97.5T140-480q0 61 19 116t63 109Zm257.814-195Q422-450 382.5-489.686q-39.5-39.686-39.5-97.5t39.686-97.314q39.686-39.5 97.5-39.5t97.314 39.686q39.5 39.686 39.5 97.5T577.314-489.5q-39.686 39.5-97.5 39.5Zm.654 370Q398-80 325-111.5q-73-31.5-127.5-86t-86-127.266Q80-397.532 80-480.266T111.5-635.5q31.5-72.5 86-127t127.266-86q72.766-31.5 155.5-31.5T635.5-848.5q72.5 31.5 127 86t86 127.032q31.5 72.532 31.5 155T848.5-325q-31.5 73-86 127.5t-127.032 86q-72.532 31.5-155 31.5ZM480-140q55 0 107.5-16T691-212q-51-36-104-55t-107-19q-54 0-107 19t-104 55q51 40 103.5 56T480-140Zm0-370q34 0 55.5-21.5T557-587q0-34-21.5-55.5T480-664q-34 0-55.5 21.5T403-587q0 34 21.5 55.5T480-510Zm0-77Zm0 374Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Active <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">001</p>
                    </div>
                </div>
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M523-523Zm-86 86Zm43 297q57 0 111.5-18.5T691-212q-47-33-100.5-53.5T480-286q-57 0-110.5 20.5T269-212q45 35 99.5 53.5T480-140Zm86-339-43-43q17-11 25.5-28t8.5-37q0-32.083-22.458-54.542Q512.083-664 480-664q-20 0-37 8.5T415-630l-43-43q20-25 48-38t60-13q56.757 0 96.879 40.121Q617-643.757 617-587q0 32-13 60t-38 48Zm236 236-41-41q29-44 44-93.5T820-480q0-142.375-98.812-241.188Q622.375-820 480-820q-53 0-102.5 15T285-760l-42-42q52-38 112.585-58Q416.17-880 480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 63.83-20 124.415Q840-295 802-243ZM479.773-80Q397-80 324-111.5T197-197q-54-54-85.5-127T80-480q0-63.83 19.5-124.415Q119-665 157-716L47-827q-9-9.067-8.5-21.533Q39-861 48.053-870q9.052-9 21.5-9Q82-879 91-870l764 765q9 9.067 8.5 21.533Q863-71 854-62q-9 9-21 9t-21-9L199-674q-30 43-44.5 92.528Q140-531.944 140-480q0 62 21.5 119.5T222-255q58-40 123.104-65.5T480-346q46 0 89.5 11t85.5 31l107 107q-56.844 57-129.645 87-72.8 30-152.582 30Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Inactive <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">003</p>
                    </div>
                </div>
            </div>

            {{-- Recent Patients --}}
            <div class="p-5 rounded-lg border border-gray-200 bg-white">
                <div class="flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-17 0-28.5-11.5T200-120v-280q0-17 11.5-28.5T240-440h40v-184l-80-79q-23-23-23-57t23-57l75-75q12-12 28.5-12t28.5 12q12 12 12 28.5T332-835l-76 75 81 80q11 11 17 26t6 31v183h40q17 0 28.5 11.5T440-400v280q0 17-11.5 28.5T400-80H240Zm320 0q-17 0-28.5-11.5T520-120v-280q0-17 11.5-28.5T560-440h40v-125q-52-14-86-56t-34-99q0-66 47-113t113-47q66 0 113 47t47 113q0 57-34 99t-86 56v125h40q17 0 28.5 11.5T760-400v280q0 17-11.5 28.5T720-80H560Zm80-560q33 0 56.5-23.5T720-720q0-33-23.5-56.5T640-800q-33 0-56.5 23.5T560-720q0 33 23.5 56.5T640-640ZM280-160h80v-200h-80v200Zm320 0h80v-200h-80v200Zm-320 0h80-80Zm320 0h80-80Z"/></svg>
                    <p>Recent Patients</p>
                </div>

                {{-- Table of Recent Patients --}}
                <x-table>
                    <x-slot name="header">
                        <th class="pl-5 py-3 text-left bg-green-50 rounded-s-lg">Time</th>
                        <th class="py-3 text-left bg-green-50">Patient name</th>
                        <th class="py-3 text-left bg-green-50">Purpose</th>
                        <th class="py-3 text-left bg-green-50">Your note</th>
                        <th class="py-3 text-left bg-green-50 rounded-e-lg"></th>
                    </x-slot>

                    <tbody>
                        <tr>
                            <td class="pl-5 border-y border-l rounded-s-lg border-gray-200">9:00 AM</td>
                            <td class="border-y border-gray-200">Juan Dela Cruz</td>
                            <td class="border-y border-gray-200">Extraction</td>
                            <td class="border-y border-gray-200">Lorem, ipsum dolor.</td>
                            <td class="py-2 px-5 border-y border-r border-gray-200 rounded-e-lg text-right">
                                <button class="px-5 py-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                                    View Record
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </x-table>
            </div>
        </section>

        {{-- Tasks --}}
        @livewire('tasks')
    </div>
</x-app-layout>
