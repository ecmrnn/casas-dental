<div>
    <x-slot name="header">
        {{ __('Profile') }}
    </x-slot>

    <div class="grid grid-cols-1 md:gap-10 xl:grid-cols-3">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif

        {{-- Dashboard Content --}}
        <section class="p-5 pt-0 flex flex-col md:p-0 w-full xl:col-span-2">

            <div class="p-5 mb-5 rounded-lg border border-gray-200 bg-white flex flex-col sm:flex-row sm:gap-5 xl:gap-10 2xl:gap-20 md:items-center">
                <div class="flex items-center gap-5 xl:gap-10 sm:flex-row sm:items-start">
                    <div class="hidden md:grid w-[100px] aspect-square rounded-lg bg-green-100 border-2 border-green-200 place-items-center">
                        <svg class="fill-green-800 opacity-50" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48"><path d="M260-280q-26 0-43-17t-17-43q0-25 17-42.5t43-17.5q25 0 42.5 17.5T320-340q0 26-17.5 43T260-280Zm0-280q-26 0-43-17t-17-43q0-25 17-42.5t43-17.5q25 0 42.5 17.5T320-620q0 26-17.5 43T260-560Zm180 120q-17 0-28.5-11.5T400-480q0-17 11.5-28.5T440-520h80q17 0 28.5 11.5T560-480q0 17-11.5 28.5T520-440h-80Zm240-40q0-54-14.5-104T623-676q-9-14-8-31t14-28q13-11 29-8.5t26 16.5q36 53 56 115.5T760-480q0 56-13.5 107T709-276q-8 15-24 19t-30-5q-14-9-17.5-25.5T642-319q18-37 28-77t10-84Z"/></svg>
                    </div>
        
                    <div>
                        <p class="poppins-bold text-xl text-left capitalize">{{ auth()->user()->name }}</p>
                        <p class="text-xs opacity-50 text-left">Joined: {{ date_format(auth()->user()->created_at, "F d, Y") }}</p>
                    </div>
                </div>
        
                <div class="mt-5 sm:mt-0 space-y-2">
                    <div class="flex items-center gap-5">
                        <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M192-144v-337l-64 49-44-58 108-82v-124h72v69l216-165 396 302-44 58-64-49v337H192Zm72-72h180v-144.27h72V-216h180v-320.334L480-701 264-537v321Zm-72-528q0-48 30-78t78-30q17 0 26.5-9.5T336-888h72q0 48-30 78t-78 30q-17 0-26.5 9.5T264-744h-72Zm72 528h432-432Z"/></svg>
                        @if (auth()->user()->address)
                            <p class="capitalize">{{ auth()->user()->address }}</p>
                        @else
                            <p class="opacity-20">Not Available</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-5">
                        <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M763-145q-121-9-229.5-59.5T339-341q-86-86-135.5-194T144-764q-2-21 12.286-36.5Q170.571-816 192-816h136q17 0 29.5 10.5T374-779l24 106q2 13-1.5 25T385-628l-97 98q20 38 46 73t57.969 65.984Q422-361 456-335.5q34 25.5 72 45.5l99-96q8-8 20-11.5t25-1.5l107 23q17 5 27 17.5t10 29.5v136q0 21.429-16 35.714Q784-143 763-145ZM255-600l70-70-17.16-74H218q5 38 14 73.5t23 70.5Zm344 344q35.1 14.243 71.55 22.622Q707-225 744-220v-90l-75-16-70 70ZM255-600Zm344 344Z"/></svg>
                        <p>{{ substr(auth()->user()->contact_number, 0, 4) . " " . substr(auth()->user()->contact_number, 4, 3) . " " . substr(auth()->user()->contact_number, 7) }}</p>
                    </div>
                    <div class="flex items-center gap-5">
                        <svg class="fill-primary shrink-0" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M480-96q-79.376 0-149.188-30Q261-156 208.5-208.5T126-330.958q-30-69.959-30-149.5Q96-560 126-629.5t82.5-122Q261-804 330.958-834q69.959-30 149.5-30Q560-864 629.5-834t122 82.5Q804-699 834-629.5T864-480v60q0 54.845-38.5 93.423Q787-288 732-288q-34 0-62.5-17t-48.66-45Q593-321 556.5-304.5T480-288q-79.68 0-135.84-56.226t-56.16-136Q288-560 344.226-616t136-56Q560-672 616-615.84T672-480v60q0 25.161 17.5 42.581Q707-360 732-360t42.5-17.419Q792-394.839 792-420v-60q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221.354 91H636q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q672-117 661.65-106.5 651.3-96 636-96H480Zm0-264q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"/></svg>
                        @if (auth()->user()->email)
                            <p>{{ auth()->user()->email }}</p>
                        @else
                            <p class="opacity-20">Not Available</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent Patients --}}
            <div class="p-5 rounded-lg border border-gray-200 bg-white flex-grow">
                <div class="mb-5 flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-17 0-28.5-11.5T200-120v-280q0-17 11.5-28.5T240-440h40v-184l-80-79q-23-23-23-57t23-57l75-75q12-12 28.5-12t28.5 12q12 12 12 28.5T332-835l-76 75 81 80q11 11 17 26t6 31v183h40q17 0 28.5 11.5T440-400v280q0 17-11.5 28.5T400-80H240Zm320 0q-17 0-28.5-11.5T520-120v-280q0-17 11.5-28.5T560-440h40v-125q-52-14-86-56t-34-99q0-66 47-113t113-47q66 0 113 47t47 113q0 57-34 99t-86 56v125h40q17 0 28.5 11.5T760-400v280q0 17-11.5 28.5T720-80H560Zm80-560q33 0 56.5-23.5T720-720q0-33-23.5-56.5T640-800q-33 0-56.5 23.5T560-720q0 33 23.5 56.5T640-640ZM280-160h80v-200h-80v200Zm320 0h80v-200h-80v200Zm-320 0h80-80Zm320 0h80-80Z"/></svg>
                    <p>Recent Appointments</p>
                </div>

                {{-- Table of Recent Patients --}}
                @if (count($completed) == 0)
                    <a wire:navigate href="{{ route('patients') }}" class="w-full block p-10 rounded-lg border border-gray-200">
                        <p class="text-center text-7xl">🤸</p>
                        <p class="mt-2 text-center poppins-bold text-2xl leading-none">No Patient Yet?</p>
                        <p class="text-center opacity-50">Click here to add one</p>
                    </a>
                @else
                    {{-- Desktop --}}
                    <div class="hidden md:block">
                        <x-table>
                            <x-slot name="header">
                                <th class="w-[24px] text-left bg-primary/5 rounded-s-lg"></th>
                                <th class="py-3 text-left bg-primary/5">Patient name</th>
                                <th class="py-3 text-left bg-primary/5">Purpose</th>
                                <th class="py-3 text-left bg-primary/5">Date</th>
                                <th class="py-3 text-left bg-primary/5 rounded-e-lg"></th>
                            </x-slot>
    
                            <tbody>
                                @foreach ($completed as $record)
                                    <tr wire:key="{{ $record->rid }}">
                                        {{-- Indicator --}}
                                        <td class="border-y border-l rounded-s-lg border-gray-200">
                                            <div class="w-[10px] m-4 aspect-square rounded-full bg-green-400">
                                            </div>
                                        </td>
                                        {{-- Patient Name --}}
                                        <td class="border-y border-gray-200 capitalize">{{ $record->first_name . " " . $record->last_name }}</td>
                                        {{-- Purpose --}}
                                        <td class="border-y border-gray-200 capitalize">{{ $record->purpose }}</td>
                                        {{-- Date --}}
                                        <td class="border-y border-gray-200 capitalize">{{ date('F j, Y', strtotime($record->completed_at)) }}</td>
                                        <td class="p-2 border-y border-r border-gray-200 rounded-e-lg text-right">
                                            <div class="flex justify-end">
                                                <livewire:patients.view-patient-record :record="$record" wire:key="{{ $record->rid }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    </div>

                    {{-- Mobile --}}
                    <div class="md:hidden space-y-2">
                        @foreach ($completed as $record)
                            <div key="{{ $record->rid }}" class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                                <div class="w-full text-left flex items-center justify-between flex-grow">
                                    <div class="flex items-center">
                                        <div class="w-[12px] m-5 aspect-square rounded-full bg-green-500">
                                        </div>
                    
                                        <div>
                                            <p class="leading-none capitalize">{{ $record->first_name . " " . $record->last_name }}</p>
                                            <p class="text-xs">
                                                <span class="capitalize">{{ $record->purpose }}</span><span class="opacity-50"> at </span><span>{{ date("F d, Y", strtotime($record->schedule_date)) }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <livewire:patients.view-patient-record :record="$record" :isIcon="true" />
                                </div>
                            </div>
                        @endforeach
                    </div> 
                @endif
            </div>
        </section>

        {{-- Tasks --}}
        @livewire('tasks.tasks')
    </div>
</div>
