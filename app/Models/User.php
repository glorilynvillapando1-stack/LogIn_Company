<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function submodules()
{
    return $this->belongsToMany(Submodule::class, 'user_submodule');
}

    protected $fillable = [
        'username',
        'email',
        'password',
        'company_id',
    ];

    protected $hidden = [
        'password',
    ];
}
