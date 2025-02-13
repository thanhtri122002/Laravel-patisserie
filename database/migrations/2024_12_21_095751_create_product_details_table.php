<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            
            $table->string('name', 255)->unique()->collation('utf8mb4_general_ci')->nullable(false);
            $table->unsignedBigInteger('quantity')->default(0);
            $table->decimal('discount', 20, 2)->default(0.0);
            $table->decimal('cost', 20, 2)->default(0.0);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('set null');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
        // Drop foreign keys
        $table->dropForeign(['product_id']);
        $table->dropForeign(['cart_id']);
        $table->dropForeign(['invoice_id']);
        });
        
        Schema::dropIfExists('product_details');
    }
};
