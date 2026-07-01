<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booths extends Model
{
    protected $primaryKey = 'booth_id';

    protected $fillable = [
        'exhibitor_id',
        'booth_number',
        'location',
        'show_id',
    ];

    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }

    public function show()
    {
        return $this->belongsTo(shows::class, 'show_id');
    }
}
