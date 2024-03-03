<?php

namespace App\Livewire;

use Livewire\Component;

class Records extends Component
{

    public $firstName = '';
    public $lastName = '';
    public $contactNumber = '';

    public function action($id)
    {
        $this->dispatch('open-modal', name: 'action-modal');
    }

    public function render()
    {
        return view('livewire.records.records');
    }
}
