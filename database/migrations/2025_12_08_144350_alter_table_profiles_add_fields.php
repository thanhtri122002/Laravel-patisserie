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
       Schema::table('profiles', function (Blueprint $table) {
        $table->string('display_name')->nullable();
        $table->string('phone', 20)->nullable();
        $table->string('address')->nullable();
        $table->string('bio')->nullable();
        $table->unique(['profilable_id', 'profilable_type'], 'profiles_profilable_unique');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropUnique('profiles_profilable_unique');
            $table->dropColumn([
                'display_name',
                'phone',
                'address',
                'bio',
            ]);
        });
    }
};
