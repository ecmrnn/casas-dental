<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Rule('required|max:40')]
    public $title = '';

    #[Rule('required|max:100')]
    public $description = '';

    public Task $selectedTask;

    public function viewTask(Task $task)
    {
        $this->selectedTask = $task;

        $this->dispatch('open-modal', name: 'view-task');
    }

    public function save()
    {
        $this->validate();

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Task added successfully!');

        return $this->redirect('/dashboard', navigate: true);
    }

    public function render()
    {
        $tasks = Task::where('status', 'incomplete')->simplePaginate(4);
        return view('livewire.tasks', [
            'tasks' => $tasks
        ]);
    }
}
