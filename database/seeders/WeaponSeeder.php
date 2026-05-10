<?php

namespace Database\Seeders;

use App\Models\Weapon;
use App\Models\WeaponProfile;
use Illuminate\Database\Seeder;

class WeaponSeeder extends Seeder
{
    public function run(): void
    {
        Weapon::factory()
            ->has(WeaponProfile::factory()->count(3), 'weaponProfiles')
            ->count(2)
            ->create();
    }
}
