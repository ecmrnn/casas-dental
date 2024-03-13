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
                                    <tr key="{{ $record->id }}">
                                        <td class="border-y border-l rounded-s-lg border-gray-200">
                                            <div class="w-[10px] m-4 aspect-square rounded-full bg-green-400">
                                            </div>
                                        </td>
                                        <td class="border-y border-gray-200 capitalize">{{ $record->first_name . " " . $record->last_name }}</td>
                                        <td class="border-y border-gray-200 capitalize">{{ $record->purpose }}</td>
                                        <td class="border-y border-gray-200 capitalize">{{ date('F d, Y', strtotime($record->completed_at)) }}</td>
                                        <td class="p-2 border-y border-r border-gray-200 rounded-e-lg text-right">
                                            <button wire:click="viewRecord()" class="px-5 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 text-sm">
                                                View Record
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    </div>

                    {{-- Mobile --}}
                    <div class="md:hidden space-y-2">
                        @foreach ($completed as $record)
                            <div class="rounded-lg bg-white border border-gray-200 flex justify-between relative">
                                <button wire:click="viewRecord()" class="w-full text-left flex items-center pr-4 flex-grow">
                                    <div class="w-[12px] m-5 aspect-square rounded-full bg-green-500">
                                    </div>
                
                                    <div>
                                        <p class="leading-none capitalize">{{ $record->first_name . " " . $record->last_name }}</p>
                                        <p class="text-xs">
                                            <span class="capitalize">{{ $record->purpose }}</span><span class="opacity-50"> at </span><span>{{ date("F d, Y", strtotime($record->schedule_date)) }}</span>
                                        </p>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div> 
                @endif
            </div>
        </section>

        {{-- Tasks --}}
        @livewire('dashboard.tasks')
    </div>
</div>
