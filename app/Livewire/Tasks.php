<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Validate]
    public $title = '';

    #[Validate]
    public $description = '';

    #[Validate]
    public $selectedTitle;

    #[Validate]
    public $selectedDescription;
    public $selectedId;

    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'description' => 'required|min:5',

            'selectedTitle' => 'required|min:5',
            'selectedDescription' => 'required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The :attribute is missing.',
            'title.min' => 'The :attribute is too short.',
            'description.required' => 'The :attribute is missing.',
            'description.min' => 'The :attribute is too short.',

            'selectedTitle.required' => 'The :attribute is missing.',
            'selectedTitle.min' => 'The :attribute is too short.',
            'selectedDescription.required' => 'The :attribute is missing.',
            'selectedDescription.min' => 'The :attribute is too short.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'selectedTitle' => 'title',
            'selectedDescription' => 'description',
        ];
    }

    public function viewTask($id)
    {
        $task = Task::find($id);
        $this->resetValidation();

        $this->selectedId = $task->id;
        $this->selectedTitle = $task->title;
        $this->selectedDescription = $task->description;
        $this->dispatch('open-modal', name: 'view-task');
    }

    public function add()
    {
        $this->reset();
        $this->dispatch('open-modal', name: 'add-task');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:5',
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Task added successfully!');

        return $this->redirect('/dashboard', navigate: true);
    }

    public function update($id)
    {
        $this->validate([
            'selectedTitle' => 'required|min:5',
            'selectedDescription' => 'required|min:5',
        ]);

        $task = Task::find($id);

        if ($task) {
            $task->title = $this->selectedTitle;
            $task->description = $this->selectedDescription;
            $task->save();
            session()->flash('success', 'Task updated successfully!');
        } else {
            session()->flash('error', 'Task not found!');
        }
        return $this->redirect('/dashboard', navigate: true);
    }

    public function completeConfirm()
    {
        $this->dispatch('open-modal-confirm', name: 'complete-confirm');
    }

    public function complete($id)
    {
        $task = Task::find($id);

        $task->status = 'complete';

        $task->save();

        session()->flash('success', 'Task completed!');
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
