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
        // Invoice::factory()->count(200)->paid()->create();
        Invoice::factory()->count(60)->paid()->create([
            'created_at' => function() {
                return now()->startOfMonth()->addDays(rand(0, now()->day - 1));
            }
        ]);
        // Invoice::factory()->count(100)->pending()->create();
        // Invoice::factory()->count(150)->unpaid()->create();
    }
}

/**
 * Note 
 * 1/ When you call create, you can pass an array of attributes to override the default factory values
 * 2/ If you pass a value, it will return same result for all record
 * 3/ if you pass a callback, it will call the callback for each record <=> each invoice will have a different created_at value
 * => Conclusion: direct value => SAME FOR ALL RECORD
 *                Closure => EVALUATED FOR EACH RECORD INDIVIDUALLY
 */
