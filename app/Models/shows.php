<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function booths()
    {
        return $this->hasMany(booths::class, 'show_id');
    }

    public static function activeShow()
    {
        return static::where('status', 'active')->first();
    }

    public function end()
    {
        $this->update(['status' => 'ended', 'end_date' => now()]);
    }
}