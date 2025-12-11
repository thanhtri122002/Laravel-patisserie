<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profile_pictures', function (Blueprint $table) {

            // ✅ remove polymorphic columns
            $table->dropMorphs('imageable');

            // ✅ add foreign key to profiles
            $table->foreignId('profile_id')
                  ->after('path')
                  ->constrained('profiles')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('profile_pictures', function (Blueprint $table) {

            // rollback FK
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');

            // rollback morphs
            $table->morphs('imageable');
        });
    }
};
