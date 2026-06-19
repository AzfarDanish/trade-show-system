<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function exhibitor()
    {
        return $this->belongsTo(exhibitors::class, 'exhibitor_id');
    }
}
