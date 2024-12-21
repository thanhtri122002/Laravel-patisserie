<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Cart::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Invoice::class)->constrained()->onDelete('cascade');
            $table->string('name', 255)->unique()->collation('utf8mb4_general_ci')->nullable(false);
            $table->unsignedBigInteger('quantity')->default(0);
            $table->decimal('discount', 20, 2)->default(0.0);
            $table->decimal('cost', 20, 2)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropForeignIdFor(Product::class);
            $table->dropForeignIdFor(Cart::class);
            $table->dropForeignIdFor(Invoice::class);
        });
        Schema::dropIfExists('product_details');
    }
};
