<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\admin\ProductService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    /**
     * Define the model's default state for the ProductDetail factory.
     *
     * This method will:
     * - Pick a random existing product from the database, or create a new one if none exists.
     * - Randomly generate quantity and discount values.
     * - Use the ProductDetail's `calculateTotal()` method to determine the cost
     *   based on the selected product, quantity, and discount.
     * - Set `cart_id` and `invoice_id` to null by default.
     *
     * @return array<string, mixed> The default attributes for a ProductDetail model.
     */
    public function definition(): array
    {
        $product = Product::query()->exists()
            ? Product::inRandomOrder()->first()
            : Product::factory();

        $quantity = $this->faker->numberBetween(1, 10);
        $discount = $this->faker->randomFloat(2, 0, 50);

        $productDetail = new ProductDetail([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'discount'   => $discount,
        ]);

        return [
            //Pick an existing product, or create one if none exists
            'product_id' =>  $product->id,
            'cart_id' => null,
            'invoice_id' => null,
            'quantity' => $quantity,
            'discount' => $discount,
            'cost' => $productDetail->calculateTotal()
        ];
    }
    /**
     * Apply an invoice association to the factory state.
     *
     * If an invoice with the given status exists, its ID will be used.
     * Otherwise, a new invoice will be created (with the specified status if provided)
     * and its ID will be assigned. The `cart_id` will always be set to null.
     *
     * @param  string|null  $status  Optional invoice status to filter by (e.g., Invoice::PAID).
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected function withInvoiceStatus($status = null): Factory
    {
        return $this->state(function () use ($status) {
            $invoiceQuery = Invoice::query();

            if ($status) {
                $invoiceQuery->where('status', $status);
            }

            if ($invoiceQuery->count() === 0) {
                $invoiceId = Invoice::factory()
                    ->state(['status' => $status])
                    ->create()
                    ->id;
            } else {
                $invoiceId = $invoiceQuery->inRandomOrder()->value('id');
            };

            return [
                'invoice_id' => $invoiceId,
                'cart_id' => null,
            ];
        });
    }

    public function forProductAndInvoice (Product $product, Invoice $invoice): Factory 
    {
        return $this->state(fn () => [
            'product_id' => $product->id,
            'invoice_id' => $invoice->id,
            'cart_id' => null,
        ]);
    }



    /**
     * Attach any invoice (regardless of status) to the factory state.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withInvoice(): Factory
    {
        return $this->withInvoiceStatus();
    }

    /**
     * Attach a paid invoice to the factory state.
     *
     * If no paid invoice exists, one will be created.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withPaidInvoice(): Factory
    {
        return $this->withInvoiceStatus(Invoice::PAID);
    }
}

/**
 * Note: 
 * A factory state MUST RETURN ATTRIBUTES FOR ONE MODEL INSTANCE 
 * => do not loop and create the model instance in the loop
 * That's SEEDER logic
 * 
 * It is not a good practice to use service in the factories, becase 
 * Factories should be isolated, predictable, reusebale, database-focused
 * Service contains business logic, depend on EXISTING DATA => circular dependencies, random failures
 */