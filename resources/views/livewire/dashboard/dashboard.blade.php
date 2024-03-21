@php
    $currentLateDate = '';
    $hour = date('H') - 1;
@endphp

<div>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    
    <div class="grid grid-cols-1 md:gap-10 xl:grid-cols-3">
        @if (session('success'))
            <x-message-success message="{{session('success')}}" />
        @endif

        {{-- Dashboard Content --}}
        <section class="p-5 pt-0 flex flex-col md:p-0 w-full xl:col-span-2">

            {{-- Cards --}}
            <div class="w-full mb-5 gap-2 grid grid-cols-3 xl:gap-5">
                {{-- Total Patients --}}
                <a wire:navigate href="{{ route('patients') }}" class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-240v-32q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v32q0 33-23.5 56.5T720-160H240q-33 0-56.5-23.5T160-240Zm80 0h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Total <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if ($patients == '0')
                                {{ __('...') }}
                            @else
                                {{ sprintf('%03d', $patients) }}
                            @endif
                        </p>
                    </div>
                </a>

                {{-- Patients Today --}}
                <div class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="m702-593 141-142q12-12 28.5-12t28.5 12q12 12 12 28.5T900-678L730-508q-12 12-28 12t-28-12l-85-85q-12-12-12-28.5t12-28.5q12-12 28-12t28 12l57 57ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 260Zm0-340Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Patients <br class="sm:hidden"> Today</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if ($scheduledTotal == 0)
                                {{ __('...') }}
                            @else
                                {{ sprintf('%03d', $scheduledTotal) }}
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Late Patients --}}
                <button
                    x-on:click="$dispatch('open-modal', { name: 'late-patients'})"
                    class="p-5 flex flex-col xl:flex-row items-center gap-5 rounded-lg border border-gray-200 bg-white">
                    <svg class="fill-primary opacity-20" xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 -960 960 960" width="40"><path d="M800-520q-17 0-28.5-11.5T760-560q0-17 11.5-28.5T800-600q17 0 28.5 11.5T840-560q0 17-11.5 28.5T800-520Zm0-120q-17 0-28.5-11.5T760-680v-120q0-17 11.5-28.5T800-840q17 0 28.5 11.5T840-800v120q0 17-11.5 28.5T800-640ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                    <div>
                        <p class="leading-none text-center xl:text-left text-sm">Late <br class="sm:hidden"> Patients</p>
                        <p class="leading-noen text-center xl:text-left text-2xl">
                            @if (count($late) == 0)
                                {{ __('...') }}
                            @else
                            {{ sprintf('%03d', count($late)) }}
                            @endif
                        </p>
                    </div>
                </button>
            </div>

            {{-- Recent Patients --}}
            <div class="p-5 rounded-lg border border-gray-200 bg-white flex-grow">
                <div class="mb-5 flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-17 0-28.5-11.5T200-120v-280q0-17 11.5-28.5T240-440h40v-184l-80-79q-23-23-23-57t23-57l75-75q12-12 28.5-12t28.5 12q12 12 12 28.5T332-835l-76 75 81 80q11 11 17 26t6 31v183h40q17 0 28.5 11.5T440-400v280q0 17-11.5 28.5T400-80H240Zm320 0q-17 0-28.5-11.5T520-120v-280q0-17 11.5-28.5T560-440h40v-125q-52-14-86-56t-34-99q0-66 47-113t113-47q66 0 113 47t47 113q0 57-34 99t-86 56v125h40q17 0 28.5 11.5T760-400v280q0 17-11.5 28.5T720-80H560Zm80-560q33 0 56.5-23.5T720-720q0-33-23.5-56.5T640-800q-33 0-56.5 23.5T560-720q0 33 23.5 56.5T640-640ZM280-160h80v-200h-80v200Zm320 0h80v-200h-80v200Zm-320 0h80-80Zm320 0h80-80Z"/></svg>
                    <p>Patients Today</p>
                </div>

                {{-- Table of Recent Patients --}}
                @if (count($scheduled) == 0)
                    <div class="w-full p-10 rounded-lg border border-gray-200">
                        <p class="text-center text-7xl">🛋️</p>
                        <p class="mt-2 text-center poppins-bold text-2xl leading-none">Rest well~</p>
                        <p class="text-center opacity-50">No scheduled patients</p>
                    </div>
                @else
                    {{-- Desktop --}}
                    <div class="hidden md:block">
                        <x-table>
                            <x-slot name="header">
                                <th class="px-6 text-left bg-primary/5 rounded-s-lg">Time</th>
                                <th class="py-3 text-left bg-primary/5">Patient name</th>
                                <th class="py-3 text-left bg-primary/5">Purpose</th>
                                <th class="py-3 text-left bg-primary/5">Your note</th>
                                <th class="py-3 text-left bg-primary/5">Status</th>
                                <th class="py-3 text-left bg-primary/5 rounded-e-lg"></th>
                            </x-slot>
    
                            <tbody>
                                @foreach ($scheduled as $record)
                                    <tr key="{{ $record->rid }}">
                                        {{-- Time --}}
                                        <td class="px-6 border-y text-nowrap border-l rounded-s-lg border-gray-200">
                                            {{ date('h:i A', strtotime($record->schedule_time)) }}
                                        </td>
                                        {{-- Patient Name --}}
                                        <td class="border-y pr-3 border-gray-200 capitalize">
                                            {{ $record->first_name . " " . $record->last_name }}
                                        </td>
                                        {{-- Purpose --}}
                                        <td class="border-y pr-3 border-gray-200 capitalize">
                                            {{ $record->purpose }}
                                        </td>
                                        {{-- Note --}}
                                        <td class="border-y pr-4 border-gray-200 capitalize">
                                            @if ($record->note)
                                                {{ $record->note }}
                                            @else
                                                <p class="opacity-20">No note</p>
                                            @endif
                                        </td>
                                        {{-- Status --}}
                                        <td class="border-y border-gray-200 capitalize">
                                            @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d ' . $hour . ':i:s'))
                                                <x-record-status status="{{$record->status}}" />
                                            @else
                                                <x-record-status status="late" />
                                            @endif
                                        </td>
                                        <td class="p-2 border-y border-r border-gray-200 rounded-e-lg text-right">
                                            <div class="flex justify-end">
                                                <livewire:patients.view-patient-record :record="$record" key="{{ $record->rid }}" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                        {{ $scheduled->links(data: ['scrollTo' => false]) }}
                    </div>

                    {{-- Mobile --}}
                    <div class="md:hidden space-y-2">
                        @foreach ($scheduled as $record)
                            <div key="{{ $record->rid }}" class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                                <div class="w-full text-left flex justify-between items-center flex-grow">
                                    <div class="flex items-center">
                                        @if ($record->schedule_date . " " . $record->schedule_time > date('Y-m-d H:i:s'))
                                            <div class="w-[12px] m-5 aspect-square rounded-full bg-orange-400">
                                            </div>
                                        @else
                                            <div class="w-[12px] m-5 aspect-square rounded-full bg-red-500">
                                            </div>
                                        @endif
                    
                                        <div>
                                            <p class="leading-none capitalize">{{ $record->first_name . " " . $record->last_name }}</p>
                                            <p class="text-xs">
                                                <span class="capitalize">{{ $record->purpose }}</span><span class="opacity-50"> at </span><span>{{ date("h:i A", strtotime($record->schedule_time)) }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <livewire:patients.view-patient-record :record="$record" :isIcon="true" key="{{ $record->rid }}" />
                                </div>
                            </div>
                        @endforeach
                        {{ $scheduled->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>

            {{-- Late Modals --}}
            <x-modal name="late-patients">
                <h2 class="p-5 text-lg poppins-bold font-medium flex items-center gap-5 border-b border-gray-200">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M800-520q-17 0-28.5-11.5T760-560q0-17 11.5-28.5T800-600q17 0 28.5 11.5T840-560q0 17-11.5 28.5T800-520Zm0-120q-17 0-28.5-11.5T760-680v-120q0-17 11.5-28.5T800-840q17 0 28.5 11.5T840-800v120q0 17-11.5 28.5T800-640ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-240v-32q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v32q0 33-23.5 56.5T600-160H120q-33 0-56.5-23.5T40-240Zm80 0h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                    {{ __('Late Patients') }}
                </h2>

                <div class="p-5 pb-0 mb-5 bg-gray-50/90 h-full sm:max-h-96 overflow-auto space-y-1">
                    @foreach ($late as $record)
                        <div>
                            <a href="{{ route('record', ['id' => $record->patient_id]) }}" key="{{ $record->rid }}" class="p-5 bg-white rounded-lg border border-gray-200 flex justify-between">
                                <div>
                                    <p class="capitalize leading-none text-lg"> {{ $record->name }} </p>
                                    <p class="capitalize text-sm leading-none"> {{ $record->purpose }} </p>
                                </div>
                                <div class="text-xs text-right">
                                    <p class=""> {{ date('F j, Y', strtotime($record->schedule_date)) }} </p>
                                    <p class=""> {{ date('g:i A', strtotime($record->schedule_time)) }} </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-modal>
        </section>

        {{-- Tasks --}}
        @livewire('tasks.tasks')
    </div>
</div>
