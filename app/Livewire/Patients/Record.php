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
    public $scheduleDate = '';
    #[Validate]
    public $scheduleTime = '';

    public Patient $patient;
    public ModelsRecord $selectedRecord;
    public $search = '';

    // Validation methods

    public function rules()
    {
        return [
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable|max:40',
            'scheduleDate' => 'nullable',
            'scheduleTime' => 'nullable',
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
        // Schedule                 Current Date
        // dd("2024-03-09 23:00:00" > date('Y-m-d h:i:s'));
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

    public function action(ModelsRecord $record)
    {
        $this->resetErrorBag();
        $this->selectedRecord = $record;
        $this->purpose = $this->selectedRecord->purpose;
        $this->note = $this->selectedRecord->note;
        $this->dispatch('open-modal', name: 'action-modal');
    }

    public function completeConfirm()
    {
        $this->dispatch('open-modal-confirm', name: 'complete-confirm');
    }

    public function complete()
    {
        $record = ModelsRecord::find($this->selectedRecord->id);
        $record->status = 'completed';
        $record->completed_at = date("Y-m-d H:i:s");
        $record->save();
        session()->flash('success', 'Record completed!');
        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
    }

    public function add()
    {
        $this->resetErrorBag();
        $this->reset('purpose', 'note');
        $this->dispatch('open-modal', name: 'add-record');
    }

    public function update()
    {
        $this->validate([
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable',
        ]);

        $record = ModelsRecord::find($this->selectedRecord->id);

        if ($record) {
            $record->purpose = $this->purpose;
            $record->note = $this->note;

            $record->save();
            session()->flash('success', 'Record updated!');
        } else {
            session()->flash('error', 'Record not found!');
        }

        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
    }

    public function confirmDelete()
    {
        $this->dispatch('open-modal-confirm', name: 'delete-confirm');
    }

    public function delete()
    {
        $record = ModelsRecord::find($this->selectedRecord->id);
        $record->delete();

        session()->flash('success', 'Record deleted!');
        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
    }

    public function save()
    {
        $this->validate([
            'purpose' => 'required|min:2',
            'status' => 'required',
            'note' => 'nullable',
        ]);
        $completedAt = null;

        if ($this->status == 'completed') {
            $completedAt = date("Y-m-d H:i:s");
            $this->scheduleDate = $completedAt;
            $this->scheduleTime = $completedAt;
        }

        ModelsRecord::create([
            'patient_id' => $this->patient->id,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'note' => $this->note,
            'schedule_date' => $this->scheduleDate,
            'schedule_time' => $this->scheduleTime,
            'completed_at' => $completedAt,
        ]);

        session()->flash('success', 'Record added!');

        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
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
            ->orderByDesc('completed_at')
            ->orderBy('schedule_date')
            ->orderBy('schedule_time')
            ->paginate(10);

        return view('livewire.patients.record', [
            'patient' => $this->patient,
            'records' => $records,
        ]);
    }
}
