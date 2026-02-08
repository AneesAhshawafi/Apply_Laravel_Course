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
        Schema::table('customers', function (Blueprint $table) {
            // $table->foreignId('added_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('added_by_user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['added_by_user_id']);
            $table->dropIndex(['added_by_user_id']);
            $table->dropColumn('added_by_user_id');
        });
    }
};
