<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Represents a physical booth space at a trade show assigned to an exhibitor.
class booths extends Model
{
    protected $primaryKey = 'booth_id';

    protected $fillable = [
        'exhibitor_id',
        'booth_number',
        'location',
        'show_id',
    ];

    // Each booth is assigned to one exhibitor.
    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }

    // Each booth belongs to a specific trade show.
    public function show()
    {
        return $this->belongsTo(shows::class, 'show_id');
    }
}
