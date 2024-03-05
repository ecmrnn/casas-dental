<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use Livewire\Component;

class Record extends Component
{
    public Patient $patient;
    public $search = '';
    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
    }

    public function render()
    {
        $records = 1;
        return view('livewire.patients.record', [
            'patient' => $this->patient,
            'records' => $records,
        ]);
    }
}
