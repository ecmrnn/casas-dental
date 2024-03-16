<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $completed = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id as rid')
            ->where('status', 'completed')
            ->where('records.deleted_at', null)
            ->orderByDesc('completed_at')
            ->paginate(8);

        return view('livewire.profile.profile', [
            'completed' => $completed,
        ]);
    }
}
