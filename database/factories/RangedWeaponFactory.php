<?php

namespace Database\Factories;

use App\Models\RangedWeapon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RangedWeapon>
 */
class RangedWeaponFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'range' => fake()->numberBetween(9, 70),
            'A' => fake()->numberBetween(1, 20),
            'BS' => fake()->numberBetween(2, 6).'+',
            'S' => fake()->numberBetween(2, 20),
            'AP' => '-'.fake()->numberBetween(1, 5),
            'D' => fake()->numberBetween(1, 6),
        ];
    }
}
