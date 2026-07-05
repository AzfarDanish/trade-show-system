<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Represents a scheduled appointment between an exhibitor and a client.
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

    // Each appointment belongs to a single exhibitor.
    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }
}
