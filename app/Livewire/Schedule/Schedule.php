<?php

namespace App\Livewire\Schedule;

use Livewire\Component;

class Schedule extends Component
{
    public $today;

    public function mount()
    {
        $this->today = date('F d, Y');
    }

    public function render()
    {
        return view('livewire.schedule.schedule', [
            'today' => $this->today,
        ]);
    }
}
