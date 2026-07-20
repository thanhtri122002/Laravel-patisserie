<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignidFor(Product::class)->constrained()->onDelete('cascade');
            $table->string('url', 500)->unique()->nullable(false)->collation('utf8mb4_general_ci');
            $table->string('name', 255)->default('null name')->collation('utf8mb4_general_ci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeignIdFor(Product::class);
        });
        Schema::dropIfExists('product_images');
    }
};
