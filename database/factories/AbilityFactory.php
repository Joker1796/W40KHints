<?php

namespace Database\Factories;

use App\Models\Ability;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ability>
 */
class AbilityFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'comment' => fake()->text(),
            'version' => 1,
        ];
    }
}
