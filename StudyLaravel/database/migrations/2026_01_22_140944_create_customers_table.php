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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('email', 255)->unique();
            $table->string('phones', 255)->unique();
            $table->string('address', 255);
            $table->text('notes');
            $table->tinyinteger('active')->default(1)->comment('هل العميل فعال ام غير فعال');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
