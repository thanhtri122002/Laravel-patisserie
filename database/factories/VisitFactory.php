<?php

namespace Database\Factories;

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
        return [
            'ip' => fake()->ipv4(),
            'device' => $this->faker->randomElement(['Desktop', 'Mobile', 'Tablet', 'Unknown']),
            'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'visitor_id' => $this->faker->uuid(),
            'url' => $this->faker->url(),
            'created_at' => $this->faker->dateTimeBetween('- 10 years', 'now'),
        ];
    }
}
