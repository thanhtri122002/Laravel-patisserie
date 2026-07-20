<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\ProductImage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Create foreign key using foreignIdFor with cascading delete
            $table->foreignIdFor(Category::class)
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('name', 255)->unique()->nullable(false);
            $table->longText('description')->nullable(true)->collation('utf8mb4_general_ci');
            $table->decimal('price', 20, 2)->nullable(false);
            $table->unsignedBigInteger('stock')->default(0);

            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraint using dropForeignIdFor
       Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        // Drop the 'products' table
        Schema::dropIfExists('products');
    }
};

