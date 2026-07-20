<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\ProductDetail;
use App\Services\admin\ProductService;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        ProductDetail::factory()->count(300)->withPaidInvoice()->create([
            'created_at' => fn () => fake()->dateTimeBetween(now()->startOfYear(), now())
        ]);

        $this->makeTopTrendingSeeder(5);
    }

    private function makeTopTrendingSeeder ($limit)
    {
        $topProducts = ProductService::getInstance()->getTopSelling($limit);

        foreach ($topProducts as $product) {
            foreach (range(1, 12) as $month) {
                $createdAt = now()
                ->copy()
                ->setMonth($month)
                ->setDay(rand(1, 28));

                $invoice = Invoice::factory()->create([
                    'status' => Invoice::PAID,
                    'created_at' => $createdAt,
                ]);

                ProductDetail::factory()->forProductAndInvoice($product, $invoice)->create([
                    'created_at' => $createdAt,
                ]);
            }
        }
    }
}

