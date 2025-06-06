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
        Schema::create('variants', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('product_id');
            $table->decimal('price', 10, 2);
            $table->string('handle')->unique();
            $table->uuid('image_id')->nullable();
            $table->timestamps();
        
            $table->foreign('product_id')->references('uuid')->on('products')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
