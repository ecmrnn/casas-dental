<?php

namespace App\Livewire\Patients;

use App\Models\Record;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewPatientRecord extends Component
{
    public $patientId;
    public $recordId;
    public $firstName;
    public $status;
    public $purpose;
    public $note;
    public $scheduleDate;
    public $scheduleTime;
    public $record;
    public $modalView;
    public $modalConfirm;
    public $isIcon = false;
    public $currentRoute;


    public function mount($record)
    {
        $this->patientId = $record->patient_id;
        $this->recordId = $record->rid;
        $this->firstName = $record->first_name;
        $this->status = $record->status;
        $this->purpose = $record->purpose;
        $this->note = $record->note;
        $this->scheduleDate = $record->schedule_date;
        $this->scheduleTime = $record->schedule_time;
        $this->modalView = 'view-record-modal-' . $this->recordId;
        $this->modalConfirm = 'confirm-record-modal-' . $this->recordId;
        $this->currentRoute = Route::getCurrentRoute()->uri();
    }

    public function viewRecord()
    {
        $this->dispatch('open-modal', name: $this->modalView);
    }

    public function completeConfirm()
    {
        $this->dispatch('open-modal-confirm', name: $this->modalConfirm);
    }

    public function complete($id)
    {
        $record = Record::find($id);
        $record->status = 'completed';
        $record->completed_at = date("Y-m-d H:i:s");
        $record->save();
        session()->flash('success', 'Record completed!');

        return $this->redirect('/' . $this->currentRoute, navigate: true);
    }
}
