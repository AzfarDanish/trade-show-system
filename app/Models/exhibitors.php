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
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function booth()
    {
        return $this->hasOne(booths::class, 'exhibitor_id');
    }
}
