<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
// Represents an authenticated system user (admin or exhibitor).
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

    // A user can have one exhibitor profile.
    public function exhibitor()
    {
        return $this->hasOne(exhibitors::class, 'user_id');
    }
}
