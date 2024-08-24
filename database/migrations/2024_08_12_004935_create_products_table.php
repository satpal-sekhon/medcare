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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_category_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->text('thumbnail')->nullable();
            $table->text('composition')->nullable();
            $table->boolean('is_prescription_required')->default(false);
            $table->enum('stock_status', ['In Stock', 'Out of Stock'])->default('In Stock');
            $table->text('short_description')->nullable();
            $table->text('Ingredients')->nullable();
            $table->longtext('description')->nullable();
            $table->timestamps();

            $table->foreign('primary_category_id')->references('id')->on('primary_categories')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
