<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $completed = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id as rid')
            ->where('status', 'completed')
            ->where('records.deleted_at', null)
            ->orderByDesc('completed_at')
            ->limit(10)
            ->get();
        return view('livewire.profile.profile', [
            'completed' => $completed,
        ]);
    }
}
