<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $name;
    public $purpose;
    public $note;
    public $scheduleDate;
    public $scheduleTime;

    public function viewRecord($id)
    {
        $record = Record::find($id);
        dd($record);
        $this->dispatch('open-modal', name: 'view-record-modal');
    }

    public function render()
    {
        $patients = Patient::all()->count();
        $scheduled = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*')
            ->where('status', 'scheduled')
            ->where(function ($query) {
                $query->where('schedule_date', '=', date('Y-m-d'));
            })
            ->paginate(10);

        $late = Record::where('status', 'scheduled')
            ->where(function ($query) {
                $query->where('schedule_date', '<=', date('Y-m-d'))
                    ->where('schedule_time', '<', date('H:i:s'));
            })
            ->get();

        return view('livewire.dashboard.dashboard', [
            'patients' => $patients,
            'late' => $late,
            'scheduled' => $scheduled,
        ]);
    }
}
