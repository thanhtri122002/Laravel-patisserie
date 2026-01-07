<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::query()->exists()
                ? Product::query()->inRandomOrder()->value('id')
                : Product::factory(),
            'name' => fake()->unique()->sentence(3),
            'url' => 'https://picsum.photos/640/640'
                . '?v=' . Str::uuid(), 
        ];
    }
}
