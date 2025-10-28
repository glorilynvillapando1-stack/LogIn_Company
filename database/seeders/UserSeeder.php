<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Company 1: TechNova
        User::create([
            'username' => 'Sabrina',
            'email' => 'sabrina@technova.com',
            'password' => Hash::make('ABC123'),
            'company_id' => 1,
        ]);

        // Company 2: GreenLeaf
        User::create([
            'username' => 'Taylor',
            'email' => 'taylor@greenleaf.com',
            'password' => Hash::make('DEF123'),
            'company_id' => 2,
        ]);
    }
}
