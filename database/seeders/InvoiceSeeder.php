<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $yesterday = now()->day - 1;
        Invoice::factory()->count(200)->paid()->create();
        Invoice::factory()->count(60)->paid()->create([
            'created_at' => function() {
                return now()->startOfMonth()->addDays(rand(0, now()->day - 1));
            }
        ]);
    }
}
