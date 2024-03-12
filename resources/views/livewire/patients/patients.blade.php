<div>
    <x-slot name="header">
        {{ __('Patients') }}
    </x-slot>

    @if (session('success'))
        <x-message-success message="{{session('success')}}" />
    @endif

    {{-- Actions --}}
    <div>
        <div class="px-5 md:p-0 flex flex-col min-[400px]:flex-row gap-2 min-[400px]:gap-5 items-start sm:justify-between">
            <x-primary-button wire:click="add" class="flex items-center gap-5 shrink-0">
                <svg class="hidden sm:block fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
                {{ __('Add Patient') }}
            </x-primary-button>
            <div class="p-3 pl-5 pb-2 w-full sm:w-auto rounded-lg border border-gray-200 bg-white flex gap-3 justify-between">
                <x-input-search wire:model.live.debounce.500ms="search" placeholder="Search a Patient" class="text-sm w-full" />
                <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M384.035-336Q284-336 214-406t-70-170q0-100 70-170t170-70q100 0 170 70t70 170.035q0 40.381-12.5 76.173T577-434l214 214q11 11 11 25t-11 25q-11 11-25.5 11T740-170L526-383q-30 22-65.792 34.5T384.035-336ZM384-408q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Z"/></svg>
            </div>
        </div>
    </div>

    {{-- Records Content --}}
    <section class="p-5 mt-5 md:rounded-lg border border-b-0 md:border-b border-gray-200 bg-white">
        <div class="mb-5 flex items-center gap-5">
            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M640-400q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM400-160v-76q0-21 10-40t28-30q45-27 95.5-40.5T640-360q56 0 106.5 13.5T842-306q18 11 28 30t10 40v76H400Zm86-80h308q-35-20-74-30t-80-10q-41 0-80 10t-74 30Zm154-240q17 0 28.5-11.5T680-520q0-17-11.5-28.5T640-560q-17 0-28.5 11.5T600-520q0 17 11.5 28.5T640-480Zm0-40Zm0 280ZM120-400v-80h320v80H120Zm0-320v-80h480v80H120Zm324 160H120v-80h360q-14 17-22.5 37T444-560Z"/></svg>
            <p>My Patients</p>
        </div>

        @if (count($patients) == 0)
            @if ($search !== '')
                <button wire:click="add" class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">😥</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">Not Found!</p>
                    <p class="mt-1 text-center opacity-50">Click here to add '{{ $search }}' in the list.</p>
                </button>
            @else
                <button wire:click="add" class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">😴</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">List is empty!</p>
                    <p class="mt-1 text-center opacity-50">No patients, click here to add one.</p>
                </button>
            @endif
        @else
            
        {{-- Desktop List --}}
        <div class="hidden md:block">
            <x-table>
                <x-slot name="header">
                    <th class="pl-5 py-3 w-20 text-left bg-primary/5 rounded-s-lg"></th>
                    <th class="py-3 md:w-1/3 text-left bg-primary/5">Patient Name</th>
                    <th class="py-3 text-left bg-primary/5">Contact Number</th>
                    <th class="py-3 text-left bg-primary/5">Date Added</th>
                    <th class="py-3 text-left bg-primary/5 rounded-e-lg"></th>
                </x-slot>
        
                <tbody>
                    @foreach ($patients as $patient)
                        <tr key="{{ $patient->id }}">
                            <td class="pl-2 border-y border-l rounded-s-lg border-gray-200">
                                <a wire:navigate href="{{ route('record', ['id' => $patient->id]) }}" class="w-[50px] h-[40px] grid place-items-center rounded-lg border border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-29.7 21.5-50.85Q139-768 168-768h185.643q14.349 0 27.353 5Q394-758 405-747l75 75h312q29.7 0 50.85 21.15Q864-629.7 864-600v336q0 29-21.15 50.5T792-192H168Zm0-72h624v-336H450l-96-96H168v432Zm0 0v-432 432Zm312-24h288v-21q0-29-44-52t-100.5-23q-56.5 0-100 22.5T480-309v21Zm144.212-144Q654-432 675-453.212q21-21.213 21-51Q696-534 674.788-555q-21.213-21-51-21Q594-576 573-554.788q-21 21.213-21 51Q552-474 573.212-453q21.213 21 51 21Z"/></svg>
                                </a>
                            </td>
                            <td class="border-y border-gray-200 capitalize">{{ $patient->first_name . " " . $patient->last_name }}</td>
                            <td class="border-y border-gray-200">{{ substr($patient->contact_number, 0, 4) . " " . substr($patient->contact_number, 4, 3) . " " . substr($patient->contact_number, 7) }}</td>
                            <td class="border-y border-gray-200">{{ date_format($patient->created_at, 'F d, Y') }}</td>
                            <td class="border-y border-r border-gray-200 rounded-e-lg flex justify-end">
                                <button wire:click="confirmDelete({{ $patient->id }})" class="p-2 m-2 mr-0 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                </button>
                                <button wire:click="action({{ $patient->id }})" class="p-2 m-2 ml-0 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                                </button>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
            {{ $patients->links(data: ['scrollTo' => false]) }}
        </div>

        {{-- Mobile List --}}
        <div class="md:hidden">
            <div class="space-y-1">
                @foreach ($patients as $patient)
                    <div class="flex items-center rounded-lg border border-gray-200 hover:bg-gray-50/90 active:bg-gray-50">
                        <a wire:navigate href="{{ route('record', ['id' => $patient->id]) }}" class="flex items-center pr-4 flex-grow">
                            <div class="p-4">
                                <svg class="fill-orange-400" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M168-192q-29 0-50.5-21.5T96-264v-432q0-30 21.5-51t50.5-21h216l96 96h312q30 0 51 21t21 51v336q0 29-21 50.5T792-192H168Z"/></svg>
                            </div>
                            <div>
                                <p class="leading-none capitalize">{{ $patient->first_name . " " . $patient->last_name }}</p>
                                <p class="leading-none text-xs opacity-50">{{ substr($patient->contact_number, 0, 4) . " " . substr($patient->contact_number, 4, 3) . " " . substr($patient->contact_number, 7) }}</p>
                            </div>
                        </a>
                        <button wire:click="action({{ $patient->id }})" class="p-2 m-2 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                        </button>
                    </div>
                @endforeach
                {{ $patients->links(data: ['scrollTo' => false]) }}
            </div>
        </div>
        @endif

            {{-- Add Patient Modal --}}
        <x-modal name="add-patient" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="save" class="relative overflow-hidden" autocomplete="off">

                <div x-data class="flex items-center justify-between border-b border-gray-200">
                    <h2 class="p-5 text-lg poppins-bold font-medium flex items-center gap-5">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M720-520h-80q-17 0-28.5-11.5T600-560q0-17 11.5-28.5T640-600h80v-80q0-17 11.5-28.5T760-720q17 0 28.5 11.5T800-680v80h80q17 0 28.5 11.5T920-560q0 17-11.5 28.5T880-520h-80v80q0 17-11.5 28.5T760-400q-17 0-28.5-11.5T720-440v-80Zm-360 40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                        {{ __('Add Patient') }}
                    </h2>
                    <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                    </button>
                </div>


                <div class="p-5 bg-gray-50/90 space-y-2">
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="firstName" value="{{ __('First Name') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="firstName"
                            type="text"
                            name="firstName"
                            id="firstName"
                            class="block w-full focus-visible:outline-none capitalize"
                            placeholder="Juan"
                            required autofocus autocomplete="firstName" />
                        <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="lastName" value="{{ __('Last Name') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="lastName"
                            type="text"
                            name="lastName"
                            id="lastName"
                            class="block w-full focus-visible:outline-none capitalize"
                            placeholder="Dela Cruz"
                            required autocomplete="lastName" />
                        <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="contactNumber" value="{{ __('Contact Number') }}" />
                        <div class="flex items-center">
                            <span class="border-b-2 border-transparent">09</span>
                            <x-text-input
                                wire:model.live.debounce.500ms="contactNumber"
                                type="text"
                                name="contactNumber"
                                id="contactNumber"
                                class="block w-full focus-visible:outline-none"
                                placeholder="xx xxx xxxx"
                                required autocomplete="contactNumber" />
                        </div>
                        <x-input-error :messages="$errors->get('contactNumber')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="address" value="{{ __('Address') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="address"
                            type="text"
                            name="address"
                            id="address"
                            class="block w-full focus-visible:outline-none capitalize"
                            placeholder="Patient Address (Optional)"
                            autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="email" value="{{ __('Email') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="email"
                            type="email"
                            name="email"
                            id="email"
                            class="block w-full focus-visible:outline-none"
                            placeholder="Patient Email (Optional)"
                            autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button wire:loading.attr="disabled" type="submit" class="flex items-center gap-3">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
                        {{ __('Add Patient') }}
                    </x-primary-button>
                </div>
            </form>

            <div
                class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg sm:rounded-lg"
                wire:loading.delay.longer
                wire:loading.grid
                wire:target="save"> 
                <div class="h-full w-full grid place-items-center">
                    <div>
                        <p class="poppins-bold text-xl text-center">Adding Patient 👨‍⚕️</p>
                        <p class="text-center">Please wait...</p>
                    </div>
                </div>
            </div>
        </x-modal>
        
        {{-- Action Modal --}}
        <x-modal name="action-modal">
            <form autocomplete="off">
                <div x-data class="flex items-center justify-between border-b border-gray-200">
                    <div class="pl-5 flex items-center gap-3">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Z"/></svg>
                        <p class="capitalize">{{ $firstName . " " . $lastName }}</p>
                    </div>
                    <button x-on:click="show = false" class="p-2 m-3 border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                    </button>
                </div>

                {{-- Patient information --}}
                <div class="p-5 space-y-2 border-b border-gray-200 bg-gray-50/90">
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="selectedFirstName" :value="__('First Name')" />
                        <x-text-input 
                        value="{{ $selectedFirstName }}"
                        wire:model.live.debounce.500ms="selectedFirstName"
                        id="selectedFirstName"
                        class="block w-full focus-visible:outline-none capitalize"
                        type="text"
                        name="selectedFirstName"
                        placeholder="Juan"
                        required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('selectedFirstName')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="selectedLastName" :value="__('Last Name')" />
                        <x-text-input
                        value="{{ $selectedLastName }}"
                        wire:model.live.debounce.500ms="selectedLastName"
                        id="selectedLastName"
                        class="block w-full focus-visible:outline-none capitalize"
                        type="text"
                        name="selectedLastName"
                        placeholder="Dela Cruz"
                        required autofocus autocomplete="lastName" />
                        <x-input-error :messages="$errors->get('selectedLastName')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="selectedContactNumber" value="{{ __('Contact Number') }}" />
                        <div class="flex items-center">
                            <span class="border-b-2 border-transparent">09</span>
                            <x-text-input
                                wire:model.live.debounce.500ms="selectedContactNumber"
                                type="text"
                                name="selectedContactNumber"
                                id="selectedContactNumber"
                                class="block w-full focus-visible:outline-none"
                                placeholder="xx xxx xxxx"
                                required autofocus autocomplete="contactNumber" />
                        </div>
                        <x-input-error :messages="$errors->get('selectedContactNumber')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="selectedAddress" :value="__('Address')" />
                        <x-text-input
                        value="{{ $selectedAddress }}"
                        wire:model.live.debounce.500ms="selectedAddress"
                        id="selectedAddress"
                        class="block w-full focus-visible:outline-none capitalize"
                        type="text"
                        name="selectedLastName"
                        placeholder="Patient Address (Optional)"
                        required autofocus autocomplete="lastName" />
                        <x-input-error :messages="$errors->get('selectedAddress')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="selectedEmail" :value="__('Email')" />
                        <x-text-input value="{{ $selectedEmail }}" wire:model.live.debounce.500ms="selectedEmail" id="selectedEmail" class="block w-full focus-visible:outline-none" type="text" name="selectedEmail" placeholder="Patient Email (Optional)" required autofocus autocomplete="lastName" />
                        <x-input-error :messages="$errors->get('selectedEmail')" class="mt-2" />
                    </div>
                </div>
                {{-- Action buttons --}}
                <div class="p-5 grid gap-5 grid-cols-2">
                    <x-secondary-button wire:click="update({{ $selectedId }})">Update Patient</x-secondary-button>
                    <x-danger-button wire:click="confirmDelete({{ $selectedId }})" type="button" class="flex items-center gap-5">
                        <svg class="fill-white hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                        Remove Patient
                    </x-danger-button>
                </div>

                <div
                    class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg sm:rounded-lg"
                    wire:loading.delay.longer
                    wire:loading.grid
                    wire:target="delete">
                    <div class="h-full w-full grid place-items-center">
                        <div>
                            <p class="poppins-bold text-xl text-center">Removing Patient 🤸</p>
                            <p class="text-center">Please wait...</p>
                        </div>
                    </div>
                </div>

                <div
                    class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg sm:rounded-lg"
                    wire:loading.delay.longer
                    wire:loading.grid
                    wire:target="update"> 
                    <div class="h-full w-full grid place-items-center">
                        <div>
                            <p class="poppins-bold text-xl text-center">Updating Patient 💾</p>
                            <p class="text-center">Please wait...</p>
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>

        {{-- Delete Confirm --}}
        <x-modal-confirmation name="delete-confirm">
            <div class="p-5 flex gap-5 items-center border-b border-gray-200">
                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M78-99q-11.483 0-19.894-5.625Q49.696-110.25 46-118q-5.167-6.6-5.583-16.8Q40-145 46-154l403-695q5-9 13.5-13.5T480-867q9 0 17.5 4.5T512-849l403 695q5 9 4.583 19.2-.416 10.2-4.583 16.8-5.044 7.4-13.522 13.2Q893-99 883-99H78Zm63-73h678L480-757 141-172Zm343.86-52q15.14 0 25.64-10.658t10.5-25.5Q521-275 510.325-286q-10.676-11-25.816-11-15.141 0-25.825 10.95Q448-275.099 448-259.825q0 14.85 10.86 25.337Q469.719-224 484.86-224Zm0-122q15.14 0 25.64-10.625T521-383v-153q0-14.775-10.675-25.388Q499.649-572 484.509-572q-15.141 0-25.825 10.612Q448-550.775 448-536v153q0 15.75 10.86 26.375Q469.719-346 484.86-346ZM480-465Z"/></svg>
                <p>Removing Patient</p>
            </div>

            <div class="p-5">
                <p>Are you sure you want to remove <span class="capitalize border-b-2 border-gray-200">{{ $selectedFirstName . " " . $selectedLastName}}</span>?</p>
            </div>

            <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                <x-secondary-button x-on:click="show = false">No, cancel</x-secondary-button>
                <x-danger-button x-on:click="show = false" wire:click="delete" class="flex items-center gap-5">
                    <svg class="fill-white hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                    Yes, remove
                </x-danger-button>
            </div>
        </x-modal-confirmation>
    </section>
</div>