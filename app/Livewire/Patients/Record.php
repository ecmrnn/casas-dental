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

    public Patient $patient;
    public ModelsRecord $selectedRecord;
    public $search = '';

    public $timeSlot = [];
    public $availableTime = [];

    // Validation methods

    public function rules()
    {
        if ($this->status == 'completed') {
            return [
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable|max:40',
                'scheduleDate' => 'required',
                'scheduleTime' => 'nullable',
            ];
        } else {
            return [
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable|max:40',
                'scheduleDate' => 'required|date|after_or_equal:today',
                'scheduleTime' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'purpose.required' => ':attribute is missing.',
            'purpose.min' => ':attribute is too short.',
            'status.required' => ':attribute is missing.',
            'scheduleDate.after_or_equal' => ':attribute must be after or equal to today.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'purpose' => 'Purpose',
            'status' => 'Status',
            'note' => 'Note',
            'scheduleDate' => 'Date',
            'scheduleTime' => 'Time',
        ];
    }

    public function mount($id)
    {
        $this->patient = Patient::findOrFail($id);
        $this->timeSlot = [];

        for ($hour = 8; $hour < 17; $hour++) {
            $this->timeSlot[] = date('H:i:s', strtotime(Carbon::createFromTime($hour, 0, 0)));
        }
    }

    public function selectTime()
    {
        $this->reset('scheduleTime');
        $this->availableTime = ModelsRecord::all()->where('schedule_date', $this->scheduleDate)->where('status', 'scheduled');
    }

    public function updateSelectedTime($time)
    {
        $this->scheduleTime = $time;
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
        $this->status = $this->selectedRecord->status;
        $this->purpose = $this->selectedRecord->purpose;
        $this->note = $this->selectedRecord->note;
        $this->scheduleDate = $this->selectedRecord->schedule_date;
        $this->selectTime();
        $this->scheduleTime = date('H:i:s', strtotime($this->selectedRecord->schedule_time));
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
    }

    public function update()
    {
        if ($this->status == 'scheduled') {
            $this->validate([
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable',
                'scheduleDate' => 'required',
                'scheduleTime' => 'required',
            ]);
        } else {
            $this->validate([
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable',
                'scheduleDate' => 'required',
                'scheduleTime' => 'nullable',
            ]);

            $this->scheduleTime = date('h:i:s', strtotime(Carbon::createFromTime(17, 0, 0)));
        }

        $record = ModelsRecord::find($this->selectedRecord->id);

        if ($record) {
            $record->purpose = $this->purpose;
            $record->note = $this->note;
            $record->schedule_date = $this->scheduleDate;
            $record->schedule_time = $this->scheduleTime;
            $record->scheduled_at = $this->scheduleDate . ' ' . $this->scheduleTime;

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
        if ($this->status == 'scheduled') {
            $this->validate([
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable',
                'scheduleDate' => 'required',
                'scheduleTime' => 'required',
            ]);

            $completedAt = null;
        } else {
            $this->validate([
                'purpose' => 'required|min:2',
                'status' => 'required',
                'note' => 'nullable',
                'scheduleDate' => 'required',
                'scheduleTime' => 'nullable',
            ]);

            $this->scheduleTime = date('H:i:s', strtotime(Carbon::createFromTime(17, 0, 0)));
            $completedAt = $this->scheduleDate . ' ' . $this->scheduleTime;
        }

        ModelsRecord::create([
            'patient_id' => $this->patient->id,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'note' => $this->note,
            'schedule_date' => $this->scheduleDate,
            'schedule_time' => $this->scheduleTime,
            'scheduled_at' => $this->scheduleDate . ' ' . $this->scheduleTime,
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
