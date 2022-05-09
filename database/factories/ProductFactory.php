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
    public function definition()
    {
        return [
            'category_id' => rand(1,3),
            'merk' => 'Rids',
            'title' => $this->faker->sentence(),
            'slug' => Str::random(10),
            'description' => $this->faker->paragraph(30),
            'price' => '25000',
        ];
    }
}
