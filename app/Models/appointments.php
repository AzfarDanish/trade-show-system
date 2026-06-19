<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class appointments extends Model
{
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'exhibitor_id',
        'client_name',
        'appointment_date',
        'appointment_time',
        'purpose',
        'status'
    ];

    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }
}
