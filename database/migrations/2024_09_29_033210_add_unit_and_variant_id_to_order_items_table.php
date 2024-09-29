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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('unit', 100)->nullable()->after('name');
            $table->unsignedBigInteger('variant_id')->nullable()->after('unit');

            $table->foreign('variant_id')->references('id')->on('product_variants')->onDelete('set null');

            // Adding index for variant_id
            $table->index('variant_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['unit', 'variant_id']);
        });
    }
};
