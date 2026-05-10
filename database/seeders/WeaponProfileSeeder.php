<?php

namespace Database\Seeders;

use App\Models\Keyword;
use App\Models\WeaponProfile;
use Illuminate\Database\Seeder;

class WeaponProfileSeeder extends Seeder
{
    public function run(): void
    {
        WeaponProfile::factory()
            ->has(Keyword::factory()->count(1))
            ->count(2)
            ->create();
    }
}
