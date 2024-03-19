<?php

namespace App\Livewire\Patients;

use App\Models\Patient;
use App\Models\Record as ModelsRecord;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Record extends Component
{
    use WithPagination, WithoutUrlPagination;

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

    public $startTime;
    public $endTime;

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
        $this->patient = Patient::findOrFail($id);
        $myCarbon = Carbon::now();
    }

    public function selectTime()
    {
        dd('hello world');
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
        $this->scheduleDate = $this->selectedRecord->schedule_date;
        $this->scheduleTime = date('H:i', strtotime($this->selectedRecord->schedule_time));
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
        $this->reset('purpose', 'note', 'scheduleDate', 'scheduleTime');
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
            $record->schedule_date = $this->scheduleDate;
            $record->schedule_time = $this->scheduleTime;

            $record->save();
            session()->flash('success', 'Record updated!');
        } else {
            session()->flash('error', 'Record not found!');
        }

        return $this->redirect("/patients/{$this->patient->id}", navigate: true);
    }

    public function confirmDelete(ModelsRecord $record)
    {
        $this->selectedRecord = $record;
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

        if ($this->status == 'scheduled') {
            $completedAt = null;
        } else {
            $completedAt = $this->scheduleDate . ' ' . $this->scheduleTime;
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
            ->simplePaginate(10);

        return view('livewire.patients.record', [
            'patient' => $this->patient,
            'records' => $records,
        ]);
    }
}
