<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'code',
        'primary_color',
        'accent_color',
        'logo_url',   // make sure this matches seeder
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
