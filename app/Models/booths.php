<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class booths extends Model
{
    protected $primaryKey = 'booth_id';

    protected $fillable = [
        'exhibitor_id',
        'booth_number',
        'location'
    ];

    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }
}
