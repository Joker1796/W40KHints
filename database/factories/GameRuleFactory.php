<?php

namespace Database\Factories;

use App\Models\GameRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GameRule>
 */
class GameRuleFactory extends Factory
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
            'text' => fake()->text(),
        ];
    }
}
