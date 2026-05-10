<?php

namespace Database\Factories;

use App\Models\WeaponProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WeaponProfile>
 */
class WeaponProfileFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'range' => fake()->numberBetween(9, 70),
            'attacks' => fake()->numberBetween(1, 20),
            'skills' => fake()->numberBetween(2, 6).'+',
            'strength' => fake()->numberBetween(2, 20),
            'penetration' => '-'.fake()->numberBetween(1, 5),
            'damage' => fake()->numberBetween(1, 6),
        ];
    }
}
