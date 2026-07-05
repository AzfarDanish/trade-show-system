<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Represents a company or individual exhibiting at a trade show.
// Central entity linking users to their booth, leads, and appointments.
class exhibitors extends Model
{
    protected $primaryKey = 'exhibitor_id';

    protected $fillable = [
        'user_id',
        'company_name',
        'representative_name',
        'phone_number',
        'status',
    ];

    // Each exhibitor belongs to a user account.
    public function user()
    {
        return $this->belongsTo(users::class, 'user_id');
    }

    // An exhibitor can have one assigned booth.
    public function booth()
    {
        return $this->hasOne(booths::class, 'exhibitor_id');
    }

    // An exhibitor can capture many leads.
    public function leads()
    {
        return $this->hasMany(leads::class, 'exhibitor_id');
    }

    // An exhibitor can have many appointments.
    public function appointments()
    {
        return $this->hasMany(appointments::class, 'exhibitor_id');
    }

    // Scope to filter only active exhibitors.
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Activate this exhibitor for the current show.
    public function joinShow()
    {
        $this->update(['status' => 'active']);
    }

    // Deactivate this exhibitor after a show ends.
    public function deactivate()
    {
        $this->update(['status' => 'inactive']);
    }
}
