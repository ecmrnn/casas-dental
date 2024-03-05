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

        @if ($records == 0)
            @if ($search !== '')
                <div class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">😥</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">Not Found!</p>
                    <p class="mt-1 text-center opacity-50">'{{ $search }}' is not in the list.</p>
                </div>
            @else
                <button wire:click="add" class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">😴</p>
                    <p class="mt-4 text-center poppins-bold text-2xl leading-none">List is empty!</p>
                    <p class="mt-1 text-center opacity-50">No records, click here to add one.</p>
                </button>
            @endif
        @else
            {{-- Desktop Records --}}

            {{-- Mobile Records --}}
            <div class="">
                <p class="mb-2 text-sm">Scheduled</p>
                <div class="rounded-lg bg-white border border-gray-200 flex justify-between">
                    <button class="w-full text-left pl-4">
                        <div>
                            
                        </div>
    
                        <div>
                            <p>Molar Extraction</p>
                            <p></p>
                        </div>
                    </button>

                    <button wire:click="action({{ $patient->id }})" class="p-2 m-2 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                    </button>
                </div>

                <p class="my-2 text-sm">Completed</p>
                <div class="rounded-lg bg-white border border-gray-200 flex justify-between">
                    <button class="w-full text-left pl-4">
                        <div>
                            
                        </div>
    
                        <div>
                            <p>Molar Extraction</p>
                            <p></p>
                        </div>
                    </button>

                    <button wire:click="action({{ $patient->id }})" class="p-2 m-2 rounded-full grid place-items-center border border-transparent hover:border-gray-200 hover:bg-gray-50 transition-all ease-in-out duration-200">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M479.788-192Q450-192 429-213.212q-21-21.213-21-51Q408-294 429.212-315q21.213-21 51-21Q510-336 531-314.788q21 21.213 21 51Q552-234 530.788-213q-21.213 21-51 21Zm0-216Q450-408 429-429.212q-21-21.213-21-51Q408-510 429.212-531q21.213-21 51-21Q510-552 531-530.788q21 21.213 21 51Q552-450 530.788-429q-21.213 21-51 21Zm0-216Q450-624 429-645.212q-21-21.213-21-51Q408-726 429.212-747q21.213-21 51-21Q510-768 531-746.788q21 21.213 21 51Q552-666 530.788-645q-21.213 21-51 21Z"/></svg>
                    </button>
                </div>
            </div>
        @endif
    </section>
</div>