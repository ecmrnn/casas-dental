<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class Schedule extends Component
{
    public $selectedDate;

    public function mount()
    {
        $this->selectedDate = date('F d, Y');
    }

    public function render()
    {
        return view('livewire.schedule.schedule', [
            'today' => $this->selectedDate,
        ]);
    }
}
