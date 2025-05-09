<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => 'Product ' . Str::random(5),
            'price'       => fake()->randomFloat(2, 10, 5000),
            'description' => fake()->optional(0.7)->paragraphs(3, true),
            'photo'      => '',
            'stock'      => fake()->numberBetween(0, 100),
        ];
    }
}
