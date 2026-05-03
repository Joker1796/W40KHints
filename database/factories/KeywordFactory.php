<?php

namespace Database\Factories;

use App\Models\Keyword;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Keyword>
 */
class KeywordFactory extends Factory
{
    /**
     * @return array<string>
     */
    public function definition(): array
    {
        return ['name' => fake()->name()];
    }
}
