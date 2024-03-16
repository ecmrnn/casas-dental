<div>
    <x-slot name="header">
        {{ __('Records') }}
        
    </x-slot>
    @if (session('success'))
        <x-message-success message="{{session('success')}}" />
    @endif

    {{-- Actions --}}
    <div>
        <div class="px-5 md:p-0 flex flex-col min-[400px]:flex-row gap-2 min-[400px]:gap-5 items-start sm:justify-between">
            <x-primary-button wire:click="add" class="flex items-center gap-5 shrink-0">
                <svg class="hidden sm:block fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
                {{ __('New Record') }}
            </x-primary-button>
            <div class="p-3 pl-5 pb-2 w-full sm:w-auto rounded-lg border border-gray-200 bg-white flex gap-3 justify-between">
                <x-input-search wire:model.live.debounce.500ms="search" placeholder="Search a Record" class="text-sm w-full" />
                <svg class="opacity-50" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M384.035-336Q284-336 214-406t-70-170q0-100 70-170t170-70q100 0 170 70t70 170.035q0 40.381-12.5 76.173T577-434l214 214q11 11 11 25t-11 25q-11 11-25.5 11T740-170L526-383q-30 22-65.792 34.5T384.035-336ZM384-408q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Z"/></svg>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5 m-5 md:m-0 md:mt-5 rounded-lg border border-gray-200 bg-white flex flex-col sm:flex-row sm:gap-5 xl:gap-10 2xl:gap-20 md:items-center">
        {{-- Patient Information --}}
        <div class="flex items-center gap-5 xl:gap-10 sm:flex-row sm:items-start">
            <div class="hidden md:grid w-[100px] aspect-square rounded-lg bg-green-50 place-items-center">
                <svg class="fill-primary opacity-50" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M260-280q-26 0-43-17t-17-43q0-25 17-42.5t43-17.5q25 0 42.5 17.5T320-340q0 26-17.5 43T260-280Zm0-280q-26 0-43-17t-17-43q0-25 17-42.5t43-17.5q25 0 42.5 17.5T320-620q0 26-17.5 43T260-560Zm180 120q-17 0-28.5-11.5T400-480q0-17 11.5-28.5T440-520h80q17 0 28.5 11.5T560-480q0 17-11.5 28.5T520-440h-80Zm240-40q0-54-14.5-104T623-676q-9-14-8-31t14-28q13-11 29-8.5t26 16.5q36 53 56 115.5T760-480q0 56-13.5 107T709-276q-8 15-24 19t-30-5q-14-9-17.5-25.5T642-319q18-37 28-77t10-84Z"/></svg>
            </div>

            <div>
                <p class="poppins-bold text-xl text-left capitalize">{{ $patient->first_name . " " . $patient->last_name }}</p>
                <p class="text-xs opacity-50 text-left">Added: {{ date_format($patient->created_at, "F d, Y") }}</p>
            </div>
        </div>

        <div class="mt-5 sm:mt-0 space-y-2">
            <div class="flex items-center gap-5">
                <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M192-144v-337l-64 49-44-58 108-82v-124h72v69l216-165 396 302-44 58-64-49v337H192Zm72-72h180v-144.27h72V-216h180v-320.334L480-701 264-537v321Zm-72-528q0-48 30-78t78-30q17 0 26.5-9.5T336-888h72q0 48-30 78t-78 30q-17 0-26.5 9.5T264-744h-72Zm72 528h432-432Z"/></svg>
                @if ($patient->address)
                    <p>{{ $patient->address }}</p>
                @else
                    <p class="opacity-20">Not Available</p>
                @endif
            </div>
            <div class="flex items-center gap-5">
                <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M763-145q-121-9-229.5-59.5T339-341q-86-86-135.5-194T144-764q-2-21 12.286-36.5Q170.571-816 192-816h136q17 0 29.5 10.5T374-779l24 106q2 13-1.5 25T385-628l-97 98q20 38 46 73t57.969 65.984Q422-361 456-335.5q34 25.5 72 45.5l99-96q8-8 20-11.5t25-1.5l107 23q17 5 27 17.5t10 29.5v136q0 21.429-16 35.714Q784-143 763-145ZM255-600l70-70-17.16-74H218q5 38 14 73.5t23 70.5Zm344 344q35.1 14.243 71.55 22.622Q707-225 744-220v-90l-75-16-70 70ZM255-600Zm344 344Z"/></svg>
                <p>{{ substr($patient->contact_number, 0, 4) . " " . substr($patient->contact_number, 4, 3) . " " . substr($patient->contact_number, 7) }}</p>
            </div>
            <div class="flex items-center gap-5">
                <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M480-96q-79.376 0-149.188-30Q261-156 208.5-208.5T126-330.958q-30-69.959-30-149.5Q96-560 126-629.5t82.5-122Q261-804 330.958-834q69.959-30 149.5-30Q560-864 629.5-834t122 82.5Q804-699 834-629.5T864-480v60q0 54.845-38.5 93.423Q787-288 732-288q-34 0-62.5-17t-48.66-45Q593-321 556.5-304.5T480-288q-79.68 0-135.84-56.226t-56.16-136Q288-560 344.226-616t136-56Q560-672 616-615.84T672-480v60q0 25.161 17.5 42.581Q707-360 732-360t42.5-17.419Q792-394.839 792-420v-60q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221.354 91H636q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q672-117 661.65-106.5 651.3-96 636-96H480Zm0-264q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"/></svg>
                @if ($patient->email)
                    <p>{{ $patient->email }}</p>
                @else
                    <p class="opacity-20">Not Available</p>
                @endif
            </div>
        </div>
    </div>
    
    {{-- Patient Records --}}
    <section class="p-5 mt-5 md:rounded-lg border border-b-0 md:border-b border-gray-200 bg-white">
        <div class="mb-5 flex items-center gap-5">
            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M640-400q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM400-160v-76q0-21 10-40t28-30q45-27 95.5-40.5T640-360q56 0 106.5 13.5T842-306q18 11 28 30t10 40v76H400Zm86-80h308q-35-20-74-30t-80-10q-41 0-80 10t-74 30Zm154-240q17 0 28.5-11.5T680-520q0-17-11.5-28.5T640-560q-17 0-28.5 11.5T600-520q0 17 11.5 28.5T640-480Zm0-40Zm0 280ZM120-400v-80h320v80H120Zm0-320v-80h480v80H120Zm324 160H120v-80h360q-14 17-22.5 37T444-560Z"/></svg>
            <p><a wire:navigate class="text-primary/50" href="{{ route('patients') }}">My Patients</a> &nbsp;&gt;&nbsp; <span class="capitalize text-primary/100">{{ $patient->first_name . " " . $patient->last_name }}</sp></p>
        </div>

        @if (count($records) == 0)
            @if ($search !== '')
                <div class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">😦</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">Not Found!</p>
                    <p class="mt-1 text-center opacity-50">Record with '{{ $search }}' is not in the list.</p>
                </div>
            @else
                <button wire:click="add" class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">📂</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">List is empty!</p>
                    <p class="mt-1 text-center opacity-50">No records, click here to add one.</p>
                </button>
            @endif
        @else
            {{-- Desktop Records --}}
            <div class="hidden md:block">
                <x-table>
                    <x-slot name="header">
                        <th class="w-[24px] text-left bg-primary/5 rounded-s-lg"></th>
                        <th class="py-3 text-left bg-primary/5">Purpose</th>
                        <th class="py-3 text-left md:w-1/3 bg-primary/5">Your Note</th>
                        <th class="py-3 text-left bg-primary/5">Status</th>
                        <th class="py-3 text-left bg-primary/5">Date & Time</th>
                        <th class="py-3 text-left bg-primary/5 rounded-e-lg"></th>
                    </x-slot>
            
                    <tbody>
                        @foreach ($records as $record)
                            <tr key="{{ $record->id }}">
                                <td class="border-y border-l rounded-s-lg border-gray-200">
                                    @if ($record->status !== 'completed')
                                        @if ($record->status == 'scheduled')
                                            @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                                <div class="w-[10px] m-4 aspect-square rounded-full bg-orange-400">
                                                </div>
                                            @else
                                                <div class="w-[10px] m-4 aspect-square rounded-full bg-red-500">
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        <div class="w-[10px] m-4 aspect-square rounded-full bg-green-400">
                                        </div>
                                    @endif
                                </td>
                                <td class="border-y border-gray-200 capitalize">{{ $record->purpose }}</td>
                                <td class="border-y border-gray-200">
                                    @if ($record->note == '')
                                        <span class="opacity-20">No note</span>
                                    @else
                                        {{ $record->note }}
                                    @endif
                                </td>
                                <td class="border-y pr-3 border-gray-200 capitalize">
                                    @if ($record->status == "completed")
                                        {{ $record->status }} 
                                    @else
                                        @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                            {{ $record->status }}   
                                        @else
                                            {{ __("Late") }}
                                        @endif
                                    @endif
                                </td>
                                <td class="border-y border-gray-200 capitalize">
                                    @if ($record->status == 'completed')
                                        {{ date("F d, Y - h:i A", strtotime($record->completed_at)) }}
                                    @else
                                        {{ date("F d, Y", strtotime($record->schedule_date)) . " - " . date("h:i A", strtotime($record->schedule_time))}}
                                    @endif
                                </td>
                                <td class="border-y border-r border-gray-200 rounded-e-lg flex justify-end">
                                    <button wire:click="viewRecord({{ $record }})" class="p-2 m-2 mr-0 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $record }})" class="p-2 m-2 mr-0 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                    </button>
                                    <button wire:click="action({{ $record->id }})" class="p-2 m-2 ml-0 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                                    </button>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
                {{ $records->links(data: ['scrollTo' => false]) }}
            </div>

            {{-- Mobile Records --}}
            <div class="md:hidden space-y-2">
                @foreach ($records as $record)
                    <div class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                        <button wire:click="viewRecord({{ $record }})" class="w-full text-left flex items-center pr-4 flex-grow">
                            @if ($record->status !== 'completed')
                                @if ($record->status == 'scheduled')
                                    @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                        <div class="w-[12px] m-4 mx-5 aspect-square rounded-full bg-orange-400">
                                        </div>
                                    @else
                                        <div class="w-[12px] m-4 mx-5 aspect-square rounded-full bg-red-500">
                                        </div>
                                    @endif
                                @endif
                            @else
                                <div class="w-[12px] m-4 mx-5 aspect-square rounded-full bg-green-400">
                                </div>
                            @endif
        
                            <div>
                                <p class="leading-none capitalize">{{ $record->purpose }}</p>
                                <p class="leading-none text-xs opacity-50 capitalize">
                                    @if ($record->status == "completed")
                                        {{ $record->status }} 
                                        : {{ date("F d, Y", strtotime($record->updated_at)) }}
                                    @else
                                        @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                            {{ $record->status }}   
                                        @else
                                            {{ __("Late") }}
                                        @endif
                                        : {{ date("F d, Y", strtotime($record->schedule_date)) }}
                                    @endif
                                </p>
                            </div>
                        </button>

                        <button wire:click="action({{ $record }})" class="p-2 m-2 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                        </button>
                    </div>
                @endforeach
                {{ $records->links(data: ['scrollTo' => false]) }}
            </div>
        @endif

        {{-- Add Record --}}
        <x-modal name="add-record" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="save" class="relative overflow-hidden" autocomplete="off">

                <div x-data class="flex items-center justify-between border-b border-gray-200">
                    <h2 class="p-5 text-lg poppins-bold font-medium flex items-center gap-5">
                        <svg class="fill-primary" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-160v-441q0-33 24-56t57-23h439q33 0 56.5 23.5T880-600v320L680-80H360q-33 0-56.5-23.5T280-160ZM81-710q-6-33 13-59.5t52-32.5l434-77q33-6 59.5 13t32.5 52l10 54h-82l-7-40-433 77 40 226v279q-16-9-27.5-24T158-276L81-710Zm279 110v440h280l160-160v-280H360Zm220 220Zm-40 160h80v-120h120v-80H620v-120h-80v120H420v80h120v120Z"/></svg>
                        {{ __('Add Record') }}
                    </h2>
                    <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                    </button>
                </div>


                <div class="p-5 bg-gray-50/90 space-y-2">
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="purpose" value="{{ __('Purpose') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="purpose"
                            type="text"
                            name="purpose"
                            id="purpose"
                            class="block w-full focus-visible:outline-none capitalize"
                            placeholder="Molar Extraction"
                            required autofocus autocomplete="purpose" />
                        <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                    </div>
                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="status" value="{{ __('Status') }}" />
                        <select wire:model.live="status" class="p-0 w-full border-0 border-b-2 border-transparent outline-none" name="status" id="status">
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    @if ($status == 'scheduled')
                        <div class="grid grid-cols-2 gap-2">
                            <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                                <x-input-label for="scheduleDate" value="{{ __('Date') }}" />
                                <input 
                                    wire:model.live.debounce.500ms="scheduleDate"
                                    type="date"
                                    name="scheduleDate"
                                    id="scheduleDate"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="p-0 w-full border-0 border-b-2 border-transparent">
                                <x-input-error :messages="$errors->get('scheduleDate')" class="mt-2" />
                            </div>
                            <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                                <x-input-label for="scheduleTime" value="{{ __('Time') }}" />
                                <input 
                                    wire:model.live.debounce.500ms="scheduleTime"
                                    type="time"
                                    name="scheduleTime"
                                    id="scheduleTime"
                                    {{-- min="8:00"
                                    max="17:00" --}}
                                    value="08:00"
                                    required
                                    class="p-0 w-full border-0 border-b-2 border-transparent">
                                <x-input-error :messages="$errors->get('scheduleTime')" class="mt-2" />
                            </div>
                        </div>                      
                    @endif

                    <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                        <x-input-label for="note" value="{{ __('My Note') }}" />
                        <textarea 
                            wire:model.live.debounce.500ms="note"
                            type="text"
                            name="note"
                            id="note"
                            class="p-0 m-0 min-h-20 block w-full focus-visible:outline-none border-0"
                            placeholder="Write a short note about your record..."
                            row="10"
                        ></textarea>
                        <x-input-error :messages="$errors->get('note')" class="mt-2" />
                    </div>
                </div>

                <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button wire:loading.attr="disabled" type="submit" class="flex items-center gap-3">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
                        {{ __('Add Record') }}
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
                        <p class="poppins-bold text-xl text-center">Adding Record ✏️</p>
                        <p class="text-center">Please wait...</p>
                    </div>
                </div>
            </div>
        </x-modal>

        {{-- Edit or Delete Record --}}
        <x-modal name="action-modal">
            @if ($selectedRecord)
                <form autocomplete="off">
                    <div x-data class="flex items-center justify-between border-b border-gray-200">
                        <div class="pl-5 sm:p-5 flex items-center gap-3">
                            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                            <p class="capitalize poppins-bold">Record Details</p>
                        </div>
                        <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                        </button>
                    </div>

                    {{-- Patient information --}}
                    <div class="p-5 space-y-2 border-b border-gray-200 bg-gray-50/90">
                        <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                            <x-input-label for="selectedPurpose" :value="__('Purpose')" />
                            <x-text-input
                                value="{{ $purpose }}"
                                wire:model.live.debounce.500ms="purpose"
                                id="selectedPurpose"
                                class="block w-full focus-visible:outline-none capitalize"
                                type="text"
                                name="selectedPurpose"
                                placeholder="Purpose"
                                required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                        </div>
                        @if ($selectedRecord->status == 'scheduled')
                            <div class="grid grid-cols-2 gap-2">
                                <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                                    <x-input-label for="scheduleDate" value="{{ __('Date') }}" />
                                    <input 
                                        wire:model.live.debounce.500ms="scheduleDate"
                                        type="date"
                                        name="scheduleDate"
                                        id="scheduleDate"
                                        min="{{ date('Y-m-d') }}"
                                        required
                                        class="p-0 w-full border-0 border-b-2 border-transparent">
                                    <x-input-error :messages="$errors->get('scheduleDate')" class="mt-2" />
                                </div>
                                <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                                    <x-input-label for="scheduleTime" value="{{ __('Time') }}" />
                                    <input 
                                        wire:model.live.debounce.500ms="scheduleTime"
                                        type="time"
                                        name="scheduleTime"
                                        id="scheduleTime"
                                        value="{{ $scheduleTime }}"
                                        required
                                        class="p-0 w-full border-0 border-b-2 border-transparent">
                                    <x-input-error :messages="$errors->get('scheduleTime')" class="mt-2" />
                                </div>
                            </div>  
                        @endif
                        <div class="py-2 px-3 rounded-lg border border-gray-200 bg-white">
                            <x-input-label for="selectedNote" value="{{ __('My Note') }}" />
                            <textarea 
                                value="{{ $note }}"
                                wire:model.live.debounce.500ms="note"
                                type="text"
                                name="selectedNote"
                                id="selectedNote"
                                class="p-0 m-0 min-h-20 block w-full focus-visible:outline-none border-0"
                                placeholder="Write a short note about your record..."
                                row="10"
                            ></textarea>
                            <x-input-error :messages="$errors->get('note')" class="mt-2" />
                        </div>
                    </div>
                    
                    {{-- Action buttons --}}
                    <div class="p-5 grid gap-5 grid-cols-2">
                        <x-secondary-button wire:click="update">{{ __('Update Record') }}</x-secondary-button>
                        <x-danger-button wire:click="confirmDelete({{ $selectedRecord }})" type="button" class="flex items-center gap-5">
                            <svg class="fill-white hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                            {{ __('Delete Record') }}
                        </x-danger-button>
                    </div>

                    <div
                        class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg sm:rounded-lg"
                        wire:loading.delay.longer
                        wire:loading.grid
                        wire:target="delete">
                        <div class="h-full w-full grid place-items-center">
                            <div>
                                <p class="poppins-bold text-xl text-center">Removing Record 🤸</p>
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
                                <p class="poppins-bold text-xl text-center">Updating Record 💾</p>
                                <p class="text-center">Please wait...</p>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </x-modal>

            {{-- View Record --}}
            <x-modal name="view-record-modal">
                @if ($selectedRecord)
                    <form autocomplete="off">
                        <div x-data class="flex items-center justify-between border-b border-gray-200">
                            <div class="pl-5 sm:p-5 flex items-center gap-3">
                                <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                                <p class="capitalize poppins-bold">Record Details</p>
                            </div>
                            <button type="button" x-on:click="show = false" class="p-2 m-3 sm:hidden border border-transparent rounded-lg hover:border-gray-200 hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                            </button>
                        </div>  

                        {{-- Patient information --}}
                        <div class="p-5 rounded-lg space-y-2 border-gray-200 bg-gray-50/90">
                            <div class="p-3 rounded-lg border border-gray-200 bg-white">
                                <p class="text-xs opacity-50">Purpose</p>
                                <h3 class="poppins-bold text-xl leading-none capitalize">{{ $selectedRecord->purpose }}</h3>
                            </div>
                            <div class="p-3 rounded-lg border border-gray-200 bg-white">
                                
                                <p class="capitalize leading-none">
                                    <span class="opacity-50">Status:</span>
                                    @if ($selectedRecord->status == 'completed')
                                        {{ $selectedRecord->status }} 
                                    @else
                                        @if ($selectedRecord->schedule_date . " " . $selectedRecord->schedule_time > date('Y-m-d H:i:s'))
                                            {{ $selectedRecord->status }} 
                                        @else
                                            {{ __("Late") }}
                                        @endif
                                    @endif
                                </p>
                                <p>
                                    @if ($selectedRecord->status == "scheduled")
                                        <span class="opacity-50">Schedule:</span>
                                        {{ date("F d, Y", strtotime($selectedRecord->schedule_date)) . " at " . date("h:i A", strtotime($selectedRecord->schedule_time)) }}
                                    @else
                                        <span class="opacity-50">On:</span>
                                        {{ date("F d, Y", strtotime($selectedRecord->updated_at)) . " at " . date("h:i A", strtotime($selectedRecord->updated_at)) }}
                                    @endif
                                </p>
                            </div>

                            <div class="p-3 min-h-40 rounded-lg border border-gray-200 bg-white">
                                <p class="text-xs opacity-50">Note</p>
                                @if ($selectedRecord->note == '')
                                    <p class="opacity-50">You have no note.</p>
                                @else
                                    <p>{{ $selectedRecord->note }}</p>
                                @endif
                            </div>

                        </div>

                        @if ($selectedRecord->status !== 'completed')
                            <div class="p-5 border-t border-gray-200">
                                <div class="flex justify-end">
                                    <x-primary-button type="button" wire:click="completeConfirm" type="button" class="flex items-center gap-3">
                                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m400-416 236-236q11-11 28-11t28 11q11 11 11 28t-11 28L428-332q-12 12-28 12t-28-12L268-436q-11-11-11-28t11-28q11-11 28-11t28 11l76 76Z"/></svg>
                                        {{ __('Record Complete') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        @endif
                    </form>
                @endif
            </x-modal>  
            
            {{-- Complete Confirm --}}
            <x-modal-confirmation name="complete-confirm">
                @if ($selectedRecord)
                    <div class="p-5 flex gap-5 items-center border-b border-gray-200">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-280q17 0 28.5-11.5T520-320v-160q0-17-11.5-28.5T480-520q-17 0-28.5 11.5T440-480v160q0 17 11.5 28.5T480-280Zm0-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                        <p>Record Completed?</p>
                    </div>

                    <div class="p-5">
                        <p>Are you sure <span class="capitalize">{{ $patient->first_name }}'s</span> <span class="capitalize border-b-2 border-gray-200">{{ $selectedRecord->purpose }}</span> was already completed?</p>
                    </div>

                    <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                        <x-secondary-button x-on:click="show = false">No, cancel</x-secondary-button>
                        <x-primary-button x-on:click="show = false" wire:click="complete">Yes, done!</x-primary-button>
                    </div>
                @endif
            </x-modal-confirmation>

            {{-- Delete Confirm --}}
            <x-modal-confirmation name="delete-confirm">
                @if ($selectedRecord)
                    <div class="p-5 flex gap-5 items-center border-b border-gray-200">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M78-99q-11.483 0-19.894-5.625Q49.696-110.25 46-118q-5.167-6.6-5.583-16.8Q40-145 46-154l403-695q5-9 13.5-13.5T480-867q9 0 17.5 4.5T512-849l403 695q5 9 4.583 19.2-.416 10.2-4.583 16.8-5.044 7.4-13.522 13.2Q893-99 883-99H78Zm63-73h678L480-757 141-172Zm343.86-52q15.14 0 25.64-10.658t10.5-25.5Q521-275 510.325-286q-10.676-11-25.816-11-15.141 0-25.825 10.95Q448-275.099 448-259.825q0 14.85 10.86 25.337Q469.719-224 484.86-224Zm0-122q15.14 0 25.64-10.625T521-383v-153q0-14.775-10.675-25.388Q499.649-572 484.509-572q-15.141 0-25.825 10.612Q448-550.775 448-536v153q0 15.75 10.86 26.375Q469.719-346 484.86-346ZM480-465Z"/></svg>
                        <p>Removing Schedule</p>
                    </div>

                    <div class="p-5">
                        <p>Are you sure you want to remove <span class="capitalize border-b-2 border-gray-200">{{ $selectedRecord->purpose }}</span> of <span class="capitalize">{{ $patient->first_name }}</span>?</p>
                    </div>

                    <div class="p-5 grid gap-5 grid-cols-2 border-t border-gray-200">
                        <x-secondary-button x-on:click="show = false">No, cancel</x-secondary-button>
                        <x-danger-button x-on:click="show = false" wire:click="delete" class="flex items-center gap-5">
                            <svg class="fill-white hidden sm:block" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                            Yes, remove
                        </x-danger-button>
                    </div>
                @endif
            </x-modal-confirmation>
    </section>
</div>