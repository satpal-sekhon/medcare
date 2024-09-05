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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('name', 100);
            $table->date('expiry_date')->nullable();
            $table->integer('stock_quantity_for_user')->default(0);
            $table->integer('stock_quantity_for_vendor')->default(0);
            $table->decimal('customer_price', 8, 2)->default(0.00);
            $table->decimal('vendor_price', 8, 2)->default(0.00);
            $table->decimal('mrp')->default(0.00);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            // Adding index
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
