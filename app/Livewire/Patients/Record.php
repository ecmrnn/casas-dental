<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use App\Models\Record as ModelsRecord;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Record extends Component
{
    #[Validate]
    public $purpose = '';
    #[Validate]
    public $status = 'scheduled';
    #[Validate]
    public $note = '';

    public Patient $patient;
    public $search = '';

    // Validation methods

    public function rules()
    {
        return [
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable|max:40',
        ];
    }

    public function messages()
    {
        return [
            'purpose.required' => ':attribute is missing.',
            'purpose.min' => ':attribute is too short.',
            'status.required' => ':attribute is missing.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'purpose' => 'Purpose',
            'status' => 'Status',
            'note' => 'Note',
        ];
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
    }

    public function add()
    {
        $this->resetErrorBag();
        $this->dispatch('open-modal', name: 'add-record');
    }

    public function save()
    {
        $this->validate([
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable',
        ]);

        ModelsRecord::create([
            'patient_id' => $this->patient->id,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'note' => $this->note,
        ]);

        session()->flash('success', 'Record added!');

        return $this->redirect('/patients/' . $this->patient->id . '/', navigate: true);
    }

    public function render()
    {
        $records = ModelsRecord::where(function ($query) {
            $query->where('patient_id', $this->patient->id);
        })->where(function ($query) {
            $query->where('purpose', 'like', "%{$this->search}%")
                ->orWhere('note', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('updated_at', 'like', "%{$this->search}%");
        })->orderByDesc('updated_at')->paginate(10);

        return view('livewire.patients.record', [
            'patient' => $this->patient,
            'records' => $records,
        ]);
    }
}
