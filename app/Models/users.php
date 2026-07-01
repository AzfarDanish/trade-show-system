<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class users extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function exhibitor()
    {
        return $this->hasOne(exhibitors::class, 'user_id');
    }
}
