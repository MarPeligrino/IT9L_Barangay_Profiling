<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Household;

class HouseholdSeeder extends Seeder
{
    public function run(): void
    {
        Household::insert([
            [
                'purok' => 'Purok 1',
                'street_number' => '101',
                'street_name' => 'Main Street',
                'apartment_unit' => null,
                'province' => 'Davao del Sur',
                'postal_code' => '8000',
                'country' => 'Philippines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purok' => 'Purok 2',
                'street_number' => '12',
                'street_name' => 'Bayanihan St.',
                'apartment_unit' => null,
                'province' => 'Davao del Sur',
                'postal_code' => '8000',
                'country' => 'Philippines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
