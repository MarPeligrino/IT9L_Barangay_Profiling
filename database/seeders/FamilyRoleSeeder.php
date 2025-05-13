<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FamilyRole;

class FamilyRoleSeeder extends Seeder
{
    public function run(): void
    {
        FamilyRole::insert([
            ['Role' => 'Father', 'Relationship' => 'Head', 'created_at' => now(), 'updated_at' => now()],
            ['Role' => 'Mother', 'Relationship' => 'Spouse', 'created_at' => now(), 'updated_at' => now()],
            ['Role' => 'Son', 'Relationship' => 'Child', 'created_at' => now(), 'updated_at' => now()],
            ['Role' => 'Daughter', 'Relationship' => 'Child', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

