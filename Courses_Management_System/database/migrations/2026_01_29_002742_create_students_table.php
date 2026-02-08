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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('phone', 255)->unique();
            $table->tinyInteger('active')->default(1); 
            $table->string('image')->nullable();
            $table->binary('image')->nullable(); // أفضل حفظ مسار/اسم الملف هنا بدلاً من الباينري
            $table->string('address', 500)->nullable();
            $table->string('notes', 255)->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            // $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
