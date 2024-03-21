<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Support\Facades\DB;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $patientId;
    public $recordId;
    public $firstName;
    public $purpose;
    public $note;
    public $scheduleDate;
    public $scheduleTime;
    public $scheduledTotal;

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

    public function render()
    {
        $hour = date('H') - 1;
        $patients = Patient::all()->count();
        $scheduled = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id AS rid')
            ->where('status', 'scheduled')
            ->where('schedule_date', '=', date('Y-m-d'))
            ->where('records.deleted_at', null)
            ->orderBy('schedule_time')
            ->paginate(8);
        $this->scheduledTotal = $scheduled->total();

        $late = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id AS rid')
            ->where('status', 'scheduled')
            ->where('schedule_date', '<=', date('Y-m-d'))
            ->where('schedule_time', '<', date($hour . ':i:s'))
            ->where('records.deleted_at', null)
            ->orderBy('schedule_time')
            ->get();
        return view('livewire.dashboard.dashboard', [
            'patients' => $patients,
            'late' => $late,
            'scheduled' => $scheduled,
        ]);
    }
}
