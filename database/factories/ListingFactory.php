<?php

namespace Database\Factories;

use App\Models\trader;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trader_id' => Trader::factory(),
            'listing_img' => fake()->imageUrl,
            'title' => fake()->colorName,
            'price' => fake()->randomElement(['24,95', '89,90', '8.99']),
            'description' => fake()->paragraph,
            'location' => fake()->address,
        ];
    }
}
