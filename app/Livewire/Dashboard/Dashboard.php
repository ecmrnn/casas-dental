<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $patientId;
    public $recordId;
    public $firstName;
    public $purpose;
    public $note;
    public $scheduleDate;
    public $scheduleTime;

    public function completeConfirm()
    {
        $this->dispatch('open-modal-confirm', name: 'complete-confirm-record');
    }

    public function complete($id)
    {
        $record = Record::find($id);
        $record->status = 'completed';
        $record->completed_at = date("Y-m-d H:i:s");
        $record->save();
        session()->flash('success', 'Record completed!');
        return $this->redirect("/dashboard", navigate: true);
    }

    public function viewRecord($id, $firstName, $patientId)
    {
        $record = Record::find($id);
        $this->patientId = $patientId;
        $this->recordId = $id;
        $this->firstName = $firstName;
        $this->purpose = $record->purpose;
        $this->note = $record->note;
        $this->scheduleDate = $record->schedule_date;
        $this->scheduleTime = $record->schedule_time;

        $this->dispatch('open-modal', name: 'view-record-modal');
    }

    public function render()
    {
        $patients = Patient::all()->count();
        $scheduled = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id AS rid')
            ->where('status', 'scheduled')
            ->where('schedule_date', '=', date('Y-m-d'))
            ->where('records.deleted_at', null)
            ->orderBy('schedule_time')
            ->paginate(10);

        $late = Record::where('status', 'scheduled')
            ->where('schedule_date', '<=', date('Y-m-d'))
            ->where('schedule_time', '<', date('H:i:s'))
            ->get();

        // dd($scheduled);

        return view('livewire.dashboard.dashboard', [
            'patients' => $patients,
            'late' => $late,
            'scheduled' => $scheduled,
        ]);
    }
}
