<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(users::class, 'user_id');
    }

    public function booth()
    {
        return $this->hasOne(booths::class, 'exhibitor_id');
    }

    public function leads()
    {
        return $this->hasMany(leads::class, 'exhibitor_id');
    }

    public function appointments()
    {
        return $this->hasMany(appointments::class, 'exhibitor_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function joinShow()
    {
        $this->update(['status' => 'active']);
    }

    public function deactivate()
    {
        $this->update(['status' => 'inactive']);
    }
}
