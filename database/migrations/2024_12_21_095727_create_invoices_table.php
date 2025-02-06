<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string('phone_number', 15)->nullable(false)->collation('utf8mb4_general_ci');
            $table->string('address', 255)->nullable(false)->collation('utf8mb4_general_ci');
            $table->string('email', 255)->collation('utf8mb4_general_ci')->nullable(false);
            $table->unsignedInteger('payment_method')->default(0);
            $table->unsignedInteger('status')->default(0);
            $table->string('order_code',20)->collation('utf8mb4_general_ci')->nullable(false)->index();
            $table->decimal('cost', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
        });
        Schema::dropIfExists('invoices');
    }
};

