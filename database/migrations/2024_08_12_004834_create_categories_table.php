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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_category_id');
            $table->string('name', 100);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('show_on_homepage')->default(false);
            $table->timestamps();

            $table->foreign('primary_category_id')->references('id')->on('primary_categories')->onDelete('cascade');

            // Adding index on primary_category_id
            $table->index('primary_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
