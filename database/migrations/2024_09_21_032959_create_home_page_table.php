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
        Schema::create('home_page', function (Blueprint $table) {
            $table->id();
            $table->json('top_header_text')->nullable();
            // Main Banner images and links
            for ($i = 1; $i <= 3; $i++) {
                $table->string("home_main_banner_image_{$i}")->nullable();
                $table->string("home_main_banner_image_{$i}_link")->nullable();
            }
            // Offer images and links
            for ($i = 1; $i <= 4; $i++) {
                $table->string("home_offer_image_{$i}")->nullable();
                $table->string("home_offer_image_{$i}_link")->nullable();
            }
            // Horizontal images and links
            for ($i = 1; $i <= 3; $i++) {
                $table->string("home_horizontal_image_{$i}")->nullable();
                $table->string("home_horizontal_image_{$i}_link")->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page');
    }
};
