<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $staticUrls = [
            'home',
            'home/products',
            'home/teams',
            'home/cart',
            'home/contact',
        ];

        // 2) collect dynamic product URLs
        $productIds = Product::pluck('id')->all();

        $dynamicUrls = array_map(function ($id) {
            return "home/products/{$id}";
        }, $productIds);

        // 3) merge them
        $allUrls = array_merge($staticUrls, $dynamicUrls);

        // 4) randomly pick one
        $url = $this->faker->randomElement($allUrls);

        return [
            'ip' => $this->faker->ipv4(),
            'device' => $this->faker->randomElement(['Desktop', 'Mobile', 'Tablet', 'Unknown']),
            'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'visitor_id' => $this->faker->uuid(),
            'url' => $url,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
