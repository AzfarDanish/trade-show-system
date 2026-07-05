<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Represents a trade show event with active status tracking and date range.
class shows extends Model
{
    protected $primaryKey = 'show_id';

    protected $fillable = [
        'name',
        'status',
        'start_date',
        'end_date',
        'poster',
    ];

    // Scope to filter only active shows.
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // A show can have many booths assigned to it.
    public function booths()
    {
        return $this->hasMany(booths::class, 'show_id');
    }

    // Get the first active show, or null if none exists.
    public static function activeShow()
    {
        return static::where('status', 'active')->first();
    }

    // Mark the show as ended and set the end date to now.
    public function end()
    {
        $this->update(['status' => 'ended', 'end_date' => now()]);
    }
}