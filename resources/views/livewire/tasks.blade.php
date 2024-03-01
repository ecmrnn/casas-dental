<aside class="min-h-[500px] w-full p-5 rounded-lg border border-gray-200">
    <div class="mb-5 flex items-center gap-5">
        <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-160v-441q0-33 24-56t57-23h439q33 0 56.5 23.5T880-600v320L680-80H360q-33 0-56.5-23.5T280-160ZM81-710q-6-33 13-59.5t52-32.5l434-77q33-6 59.5 13t32.5 52l10 54h-82l-7-40-433 77 40 226v279q-16-9-27.5-24T158-276L81-710Zm279 110v440h280v-160h160v-280H360Zm220 220Z"/></svg>
        <h2>Tasks</h2>
    </div>

    <div class="flex flex-col justify-between">
        <div>
            @if (count($tasks) == 0)
                <div class="p-10 border border-gray-200 rounded-lg">
                    <p class="text-center poppins-bold text-2xl leading-none">Hooray!</p>
                    <p class="text-center opacity-50">No tasks 🎊</p>
                </div>
            @else    
                <div class="space-y-1">
                    @foreach ($tasks as $task)
                        <div 
                            key="{{$task->id}}"
                            wire:click="viewTask({{ $task }})"
                            class="block p-3 rounded-lg border border-gray-200 hover:border-gray-300 hover:cursor-pointer hover:bg-gray-50 transition-all ease-in-out duration-200">
                            <h3 class="text-lg leading-none">{{ $task->title }}</h3>
                            <p class="mb-3 leading-none line-clamp-2">{{ $task->description}}</p>
                            <p class="text-sm opacity-50">{{ date_format($task->created_at, 'h:i A') }} - {{ date_format($task->created_at, 'F d, Y') }}</p>
                        </div>
                    @endforeach
                    {{ $tasks->links(data: ['scrollTo' => false]) }}
                </div>
            @endif
        </div>

        <button 
            type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', {name: 'add-task'})"
            class="mt-1 px-5 py-3 flex gap-5 rounded-lg border border-gray-200 self-end hover:bg-gray-50">
            <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z"/></svg>
            Add Task
        </button>

        <x-modal name="add-task" :show="$errors->isNotEmpty()" focusable>
            <form class="p-5 relative overflow-hidden" autocomplete="off">

                <h2 class="text-lg poppins-bold font-medium flex items-center gap-5">
                    <svg class="fill-primary" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M280-160v-441q0-33 24-56t57-23h439q33 0 56.5 23.5T880-600v320L680-80H360q-33 0-56.5-23.5T280-160ZM81-710q-6-33 13-59.5t52-32.5l434-77q33-6 59.5 13t32.5 52l10 54h-82l-7-40-433 77 40 226v279q-16-9-27.5-24T158-276L81-710Zm279 110v440h280l160-160v-280H360Zm220 220Zm-40 160h80v-120h120v-80H620v-120h-80v120H420v80h120v120Z"/></svg>
                    {{ __('Add Task') }}
                </h2>
    
                <div class="mt-5">
                    <div class="py-2 px-3 rounded-lg border border-gray-200">
                        <x-input-label for="title" value="{{ __('Title') }}" />
                        <x-text-input
                            wire:model.live.debounce.500ms="title"
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
                            wire:model="description"
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
    
                    <x-primary-button type="button" wire:click="save" class="ms-3 flex items-center gap-3">
                        <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-440H240q-17 0-28.5-11.5T200-480q0-17 11.5-28.5T240-520h200v-200q0-17 11.5-28.5T480-760q17 0 28.5 11.5T520-720v200h200q17 0 28.5 11.5T760-480q0 17-11.5 28.5T720-440H520v200q0 17-11.5 28.5T480-200q-17 0-28.5-11.5T440-240v-200Z"/></svg>
                        {{ __('Add Task') }}
                    </x-primary-button>
                </div>

                <div
                    class="absolute inset-0 w-full h-full bg-white"
                    wire:loading.delay.shortest
                    wire:loading.grid
                    wire:target="save"> 
                    <div class="h-full w-full grid place-items-center">
                        <div>
                            <p class="poppins-bold text-xl text-center">Writing task ✏️</p>
                            <p class="text-center">Please wait...</p>
                        </div>
                    </div>
                </div>
            </form>
        </x-modal>

        @if ($selectedTask)
            <x-modal name="view-task">
                <div class="p-5">
                    <p>Title: {{ $selectedTask->title }}</p>
                    <p>Description: {{ $selectedTask->description }}</p>
                </div>
            </x-modal>
        @endif
    </div>
</aside>