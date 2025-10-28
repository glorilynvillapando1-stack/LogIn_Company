<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'TechNova Solutions',
                'code' => 'TECHNOVA',
                'location' => 'Manila',
                'primary_color' => '#7c3aed',   // purple pastel
                'accent_color' => '#facc15',    // soft yellow
                'logo_url' => '/logos/technova.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'GreenLeaf Enterprises',
                'code' => 'GREENLEAF',
                'location' => 'Cebu',
                'primary_color' => '#22c55e',   // green theme
                'accent_color' => '#86efac',
                'logo_url' => '/logos/greenleaf.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
