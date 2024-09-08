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
            $table->unsignedBigInteger('primary_category_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name', 100);
            $table->string('unit', 100)->nullable();
            $table->enum('product_type', ['General', 'Generic'])->default('General');
            $table->text('thumbnail')->nullable();
            $table->text('composition')->nullable();
            $table->boolean('is_prescription_required')->default(false);
            $table->boolean('show_on_homepage')->default(false);
            $table->string('flag', 25)->nullable();
            $table->enum('stock_type', ['With Stock', 'Without Stock'])->default('Without Stock');
            $table->integer('stock_quantity_for_customer')->default(0);
            $table->integer('stock_quantity_for_vendor')->default(0);
            $table->decimal('customer_price', 8, 2)->default(0.00);
            $table->decimal('vendor_price', 8, 2)->default(0.00);
            $table->decimal('mrp', 8, 2)->default(0.00);
            $table->decimal('weight', 8, 2)->default(0.00);
            $table->date('expiry_date')->nullable();
            $table->text('short_description')->nullable();
            $table->text('ingredients')->nullable();
            $table->longtext('description')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();

            $table->foreign('primary_category_id')->references('id')->on('primary_categories')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');

            // Adding indexes
            $table->index('primary_category_id');
            $table->index('category_id');
            $table->index('brand_id');
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
