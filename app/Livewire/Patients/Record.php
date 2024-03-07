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
    #[Validate]
    public $scheduleDate = null;
    #[Validate]
    public $scheduleTime = null;
    public $selectedId = '';

    public Patient $patient;
    public ModelsRecord $selectedRecord;
    public $search = '';

    #[Validate]
    public $selectedPurpose;
    #[Validate]
    public $selectedNote;
    public $selectedStatus;
    public $selectedDate;
    public $selectedTime;

    // Validation methods

    public function rules()
    {
        return [
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable|max:40',
            'scheduleDate' => 'nullable',
            'scheduleTime' => 'nullable',

            'selectedPurpose' => 'required|min:2',
            'selectedNote' => 'nullable|max:40',
        ];
    }

    public function messages()
    {
        return [
            'purpose.required' => ':attribute is missing.',
            'purpose.min' => ':attribute is too short.',
            'status.required' => ':attribute is missing.',

            'selectedPurpose.required' => ':attribute is missing.',
            'selectedPurpose.min' => ':attribute is too short.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'purpose' => 'Purpose',
            'status' => 'Status',
            'note' => 'Note',
            'selectedPurpose' => 'Purpose',
            'selectedNote' => 'Note',
        ];
    }

    public function mount($id)
    {
        // dd("2024-03-07" <= date('Y-m-d'));
        $this->patient = Patient::findOrFail($id);

        if (count(ModelsRecord::all()) == 0) {
            /* 
                Creates a dummy record if the records table is empty
            */
            ModelsRecord::create([
                'patient_id' => 1,
                'purpose' => 'test',
                'status' => 'test',
                'note' => 'this is a dummy record',
                'schedule_date' => '2024/01/01',
                'schedule_time' => '08:00:00',
            ]);
        } else {
            $this->selectedRecord = ModelsRecord::findOrFail(1);
        }
    }

    public function viewRecord(ModelsRecord $record)
    {
        $this->selectedRecord = $record;
        $this->dispatch('open-modal', name: 'view-record-modal');
    }

    public function action($id)
    {
        $this->resetErrorBag();
        $this->dispatch('open-modal', name: 'action-modal');
        $this->selectedRecord = ModelsRecord::find($id);
    }

    public function completeConfirm()
    {
        $this->dispatch('open-modal-confirm', name: 'complete-confirm');
    }

    public function complete()
    {
        $record = ModelsRecord::find($this->selectedRecord->id);
        $record->status = 'completed';
        $record->save();
        session()->flash('success', 'Record completed!');
        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
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
            'schedule_date' => $this->scheduleDate,
            'schedule_time' => $this->scheduleTime,
        ]);

        session()->flash('success', 'Record added!');

        return $this->redirect('/patients/' . $this->patient->id . '/', navigate: true);
    }

    public function render()
    {
        /* 
            Retrieves all records of a patient, works with searches
        */
        $records = ModelsRecord::where(function ($query) {
            $query->where('patient_id', $this->patient->id);
        })->where(function ($query) {
            $query->where('purpose', 'like', "%{$this->search}%")
                ->orWhere('note', 'like', "%{$this->search}%")
                ->orWhere('status', 'like', "%{$this->search}%")
                ->orWhere('updated_at', 'like', "%{$this->search}%");
        })
            ->orderByDesc('status')
            ->orderByDesc('schedule_time')
            ->orderByDesc('schedule_date')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('livewire.patients.record', [
            'patient' => $this->patient,
            'records' => $records,
        ]);
    }
}
