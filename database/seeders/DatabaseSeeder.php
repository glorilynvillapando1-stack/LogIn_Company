<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Companies
        $company1 = Company::create([
            'name' => 'Technova',
            'primary_color' => '#6f42c1', // purple
            'logo_path' => '/logos/technova_logo.png',
        ]);

        $company2 = Company::create([
            'name' => 'Greenleaf',
            'primary_color' => '#28a745', // green
            'logo_path' => '/logos/greenleaf_logo.png',
        ]);

        // Create Users for Technova
        User::create([
            'username' => 'testuser',
            'email' => 'tech@nova.com',
            'password' => Hash::make('1234'),
            'company_id' => $company1->id,
        ]);

        User::create([
            'username' => 'Sabrina',
            'email' => 'sabrina@nova.com',
            'password' => Hash::make('ABC123'),
            'company_id' => $company1->id,
        ]);

        // Create Users for Greenleaf
        User::create([
            'username' => 'testuser',
            'email' => 'green@leaf.com',
            'password' => Hash::make('1234'),
            'company_id' => $company2->id,
        ]);

        User::create([
            'username' => 'Taylor',
            'email' => 'taylor@greenleaf.com',
            'password' => Hash::make('DEF123'),
            'company_id' => $company2->id,
        ]);
    }

    
}
