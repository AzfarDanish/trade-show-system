<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Represents a sales lead or prospect captured by an exhibitor.
class leads extends Model
{
    protected $primaryKey = 'lead_id';

    protected $fillable = [
        'exhibitor_id',
        'lead_name',
        'company_name',
        'phone',
        'email',
        'notes'
    ];

    // Each lead belongs to a single exhibitor.
    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }
}
