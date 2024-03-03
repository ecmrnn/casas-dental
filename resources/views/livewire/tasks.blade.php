<aside class="min-h-[500px] w-full p-5 rounded-lg border border-gray-200 bg-white">

    <div class="mb-5 flex items-center gap-5">
        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-160v-441q0-33 24-56t57-23h439q33 0 56.5 23.5T880-600v320L680-80H360q-33 0-56.5-23.5T280-160ZM81-710q-6-33 13-59.5t52-32.5l434-77q33-6 59.5 13t32.5 52l10 54h-82l-7-40-433 77 40 226v279q-16-9-27.5-24T158-276L81-710Zm279 110v440h280v-160h160v-280H360Zm220 220Z"/></svg>
        <h2>Tasks</h2>
    </div>

    <div class="flex flex-col justify-between">

        {{-- Task List --}}

        <div>
            @if (count($tasks) == 0)
                <button wire:click="add" class="w-full p-10 border border-gray-200 rounded-lg">
                    <p class="text-center text-7xl">🎊</p>
                    <p class="mt-2 text-center poppins-bold text-2xl leading-none">Hooray!</p>
                    <p class="text-center opacity-50">No tasks, click here to add one.</p>
                </button>
            @else    
                <div class="space-y-1">
                    @foreach ($tasks as $task)
                        <button
                            key="{{$task->id}}"
                            wire:click="viewTask({{ $task->id }})"
                            class="block text-left w-full p-3 rounded-lg border border-gray-200 hover:border-gray-300 hover:cursor-pointer hover:bg-gray-50 transition-all ease-in-out duration-200">
                            <h3 class="text-lg leading-none">{{ $task->title }}</h3>
                            <p class="mb-3 line-clamp-3">{{ $task->description}}</p>
                            <p class="text-sm opacity-50">{{ date_format($task->created_at, 'h:i A') }} - {{ date_format($task->created_at, 'F d, Y') }}</p>
                        </button>
                    @endforeach
                    {{ $tasks->links(data: ['scrollTo' => false]) }}
                </div>
            @endif
        </div>

        <x-primary-button 
            type="button"
            x-data=""
            wire:click="add"
            class="mt-1 flex gap-5 items-center self-end">
            <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
            Add Task
        </x-primary-button>

        {{-- Add Task Modal --}}

        <x-modal name="add-task" :show="$errors->isNotEmpty()" focusable>
            <form wire:submit="save" class="p-5 relative overflow-hidden" autocomplete="off">

                <h2 class="text-lg poppins-bold font-medium flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-160v-441q0-33 24-56t57-23h439q33 0 56.5 23.5T880-600v320L680-80H360q-33 0-56.5-23.5T280-160ZM81-710q-6-33 13-59.5t52-32.5l434-77q33-6 59.5 13t32.5 52l10 54h-82l-7-40-433 77 40 226v279q-16-9-27.5-24T158-276L81-710Zm279 110v440h280l160-160v-280H360Zm220 220Zm-40 160h80v-120h120v-80H620v-120h-80v120H420v80h120v120Z"/></svg>
                    {{ __('Add Task') }}
                </h2>
    
                <div class="mt-5">
                    <div class="py-2 px-3 rounded-lg border border-gray-200">
                        <x-input-label for="title" value="{{ __('Title') }}" />
                        <x-text-input
                            wire:model.live.debounce.250ms="title"
                            type="text"
                            name="title"
                            id="title"
                            class="block w-full focus-visible:outline-none"
                            placeholder="Task title goes here..."
                            required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mt-2 py-2 px-3 rounded-lg border border-gray-200">
                        <x-input-label for="description" value="{{ __('Description') }}" />
                        <textarea 
                            wire:model.live.debounce.250ms="description"
                            type="text"
                            name="description"
                            id="description"
                            class="p-0 m-0 min-h-20 block w-full focus-visible:outline-none border-0"
                            placeholder="Write a short description about your task..."
                            row="10"
                        ></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>
    
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
    
                    <x-primary-button wire:loading.attr="disabled" type="submit" class="ms-3 flex items-center gap-3">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M444-444H276q-15.3 0-25.65-10.289-10.35-10.29-10.35-25.5Q240-495 250.35-505.5 260.7-516 276-516h168v-168q0-15.3 10.289-25.65 10.29-10.35 25.5-10.35Q495-720 505.5-709.65 516-699.3 516-684v168h168q15.3 0 25.65 10.289 10.35 10.29 10.35 25.5Q720-465 709.65-454.5 699.3-444 684-444H516v168q0 15.3-10.289 25.65-10.29 10.35-25.5 10.35Q465-240 454.5-250.35 444-260.7 444-276v-168Z"/></svg>
                        {{ __('Add Task') }}
                    </x-primary-button>
                </div>
            </form>

            <div
                class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg"
                wire:loading.delay.longer
                wire:loading.grid
                wire:target="save"> 
                <div class="h-full w-full grid place-items-center">
                    <div>
                        <p class="poppins-bold text-xl text-center">Writing task ✏️</p>
                        <p class="text-center">Please wait...</p>
                    </div>
                </div>
            </div>
        </x-modal>

        {{-- View Task Modal --}}

        <x-modal name="view-task">
            <form class="p-5 relative overflow-hidden" autocomplete="off">
                <h2 class="text-lg poppins-bold font-medium flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M360-240h240q17 0 28.5-11.5T640-280q0-17-11.5-28.5T600-320H360q-17 0-28.5 11.5T320-280q0 17 11.5 28.5T360-240Zm0-160h240q17 0 28.5-11.5T640-440q0-17-11.5-28.5T600-480H360q-17 0-28.5 11.5T320-440q0 17 11.5 28.5T360-400ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h287q16 0 30.5 6t25.5 17l194 194q11 11 17 25.5t6 30.5v447q0 33-23.5 56.5T720-80H240Zm280-560v-160H240v640h480v-440H560q-17 0-28.5-11.5T520-640ZM240-800v200-200 640-640Z"/></svg>
                    {{ __('Update / Complete Task') }}
                </h2>
                <div class="mt-5">
                    <div class="py-2 px-3 rounded-lg border border-gray-200">
                        <x-input-label for="title" value="{{ __('Title') }}" />
                        <x-text-input
                            wire:model.live.debounce.250ms="selectedTitle"
                            type="text"
                            name="title"
                            id="title"
                            value="{{ $selectedTitle }}"
                            class="block w-full focus-visible:outline-none"
                            placeholder="Task title goes here..."
                            required autofocus />
                        <x-input-error :messages="$errors->get('selectedTitle')" class="mt-2" />
                    </div>
                    <div class="mt-2 py-2 px-3 rounded-lg border border-gray-200">
                        <x-input-label for="description" value="{{ __('Description') }}" />
                        <textarea
                            wire:model.live.debounce.250ms="selectedDescription"
                            type="text"
                            name="description"
                            id="description"
                            value="{{ $selectedDescription }}"
                            class="p-0 m-0 min-h-20 block w-full focus-visible:outline-none border-0"
                            placeholder="Write a short description about your task..."
                            row="10"
                        ></textarea>
                        <x-input-error :messages="$errors->get('selectedDescription')" class="mt-2" />
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-1">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                    <x-secondary-button type="button" wire:click="update({{ $selectedId }})" class="flex items-center gap-3">
                        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20"><path d="M216-144q-29.7 0-50.85-21.15Q144-186.3 144-216v-528q0-29.7 21.15-50.85Q186.3-816 216-816h426q14.222 0 27.111 5Q682-806 693-795l102 102q11 11 16 23.889T816-642v426q0 29.7-21.15 50.85Q773.7-144 744-144H216Zm528-498L642-744H216v528h528v-426ZM480-252q45 0 76.5-31.5T588-360q0-45-31.5-76.5T480-468q-45 0-76.5 31.5T372-360q0 45 31.5 76.5T480-252ZM300-552h264q15.3 0 25.65-10.325Q600-572.65 600-587.912v-71.825Q600-675 589.65-685.5 579.3-696 564-696H300q-15.3 0-25.65 10.325Q264-675.35 264-660.088v71.825Q264-573 274.35-562.5 284.7-552 300-552Zm-84-77v413-528 115Z"/></svg>
                        {{ __('Update Task') }}
                    </x-secondary-button>
                    <x-primary-button type="button" wire:click="complete({{ $selectedId }})" type="button" class="flex items-center gap-3">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m400-416 236-236q11-11 28-11t28 11q11 11 11 28t-11 28L428-332q-12 12-28 12t-28-12L268-436q-11-11-11-28t11-28q11-11 28-11t28 11l76 76Z"/></svg>
                        {{ __('Complete Task') }}
                    </x-primary-button>
                </div>
            </form>

            <div
                class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg"
                wire:loading.delay.longer
                wire:loading.grid
                wire:target="update"> 
                <div class="h-full w-full grid place-items-center">
                    <div>
                        <p class="poppins-bold text-xl text-center">Updating task 💾</p>
                        <p class="text-center">Please wait...</p>
                    </div>
                </div>
            </div>

            <div
                class="absolute inset-0 w-full h-full bg-white rounded-ss-lg rounded-se-lg"
                wire:loading.delay.longer
                wire:loading.grid
                wire:target="complete"> 
                <div class="h-full w-full grid place-items-center">
                    <div>
                        <p class="poppins-bold text-xl text-center">Completing task ✅</p>
                        <p class="text-center">Please wait...</p>
                    </div>
                </div>
            </div>
        </x-modal>
    </div>
</aside>