<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');          // floral, minimalist, elegant, etc.
            $table->unsignedInteger('price')->default(0); // 0 = free, in IDR
            $table->string('badge')->nullable();  // popular | new | free | null
            $table->string('html_path');          // relative path inside storage
            $table->string('thumbnail_path')->nullable(); // relative path inside storage/public
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
