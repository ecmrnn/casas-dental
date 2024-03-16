<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($patient) {
            $patient->records()->delete();
        });
    }

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'contact_number',
        'address',
        'email',
    ];
}
