<?php

namespace Database\Factories;

use App\Models\Wargear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Wargear>
 */
class WargearFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
