<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'purpose',
        'status',
        'note',
        'schedule_date',
        'schedule_time',
        'completed_at',
    ];
}
