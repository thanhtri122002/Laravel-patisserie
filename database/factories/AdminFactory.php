<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{   

    protected static ?string $password; 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement([
                Admin::ROLE_ADMIN,
                Admin::ROLE_MANAGER,
                Admin::ROLE_ACCOUNTANT,
                Admin::ROLE_STORAGE_CHECKER,
            ]),
            'email_verified_at' => now(),
            'password' => Str::random(10),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified() : static 
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function superAdmin(): static
    {
        return $this->state(fn () => [
            'role' => Admin::ROLE_SUPER_ADMIN,
        ]);
    }

    public function manager(): static
    {
        return $this->state(fn () => [
            'role' => Admin::ROLE_MANAGER,
        ]);
    }

    public function accountant(): static
    {
        return $this->state(fn () => [
            'role' => Admin::ROLE_ACCOUNTANT,
        ]);
    }

    public function storageChecker(): static
    {
        return $this->state(fn () => [
            'role' => Admin::ROLE_STORAGE_CHECKER,
        ]);
    }
}
