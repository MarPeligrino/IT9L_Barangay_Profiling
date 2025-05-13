<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CurrentAddress;

class CurrentAddressSeeder extends Seeder
{
    public function run(): void
    {
        CurrentAddress::insert([
            [
                'purok' => 'Purok 1',
                'street_number' => '25',
                'street_name' => 'Palm Drive',
                'apartment_unit' => null,
                'province' => 'Davao del Sur',
                'postal_code' => '8002',
                'country' => 'Philippines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purok' => 'Purok 2',
                'street_number' => '88',
                'street_name' => 'Coconut Avenue',
                'apartment_unit' => 'Unit 3A',
                'province' => 'Davao del Sur',
                'postal_code' => '8002',
                'country' => 'Philippines',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

