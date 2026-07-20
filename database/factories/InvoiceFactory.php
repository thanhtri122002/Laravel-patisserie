<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::count() === 0 ? User::factory() : User::inRandomOrder()->first()->id,
            'phone_number' => substr(preg_replace('/\D+/', '', $this->faker->phoneNumber()), 0, 15),
            'address' => $this->faker->address,
            'email' => $this->faker->safeEmail,
            'payment_method' => $this->faker->randomElement([
                Invoice::PAYMENT_METHOD_CREDIT_CARD,
                Invoice::PAYMENT_METHOD_PAYPAL,
                Invoice::PAYMENT_METHOD_BANK_TRANSFER,
                Invoice::PAYMENT_METHOD_CASH
            ]),
            'order_code'   => 'INV-' . now()->format("Ymd") . '-' . Str::upper(Str::random(5)),
            'cost' => $this->faker->randomFloat(2, 10000, 500000),
            'status' => $this->faker->randomElement([
                Invoice::PENDING,
                Invoice::UNPAID,
                Invoice::PAID,
                Invoice::CANCELLED
            ]),
            'created_at' => $this->faker->dateTimeBetween('- 10 years', 'now'),
        ];
    }

    /**
     * Indicate that the invoice is paid
     */
    public function paid(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Invoice::PAID
            ];
        });
    }
    
    /**
     * 
     */
    public function unpaid(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Invoice::UNPAID
            ];
        });
    }

    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Invoice::PENDING
            ];
        });
    }

    public function cancelled(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => Invoice::CANCELLED
            ];
        });
    }
}
