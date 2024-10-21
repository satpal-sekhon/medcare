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
        Schema::table('home_page', function (Blueprint $table) {
            $table->string('home_main_banner_image_4')->nullable();
            $table->string('home_main_banner_image_4_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page', function (Blueprint $table) {
            $table->dropColumn(['home_main_banner_image_4', 'home_main_banner_image_4_link']);
        });
    }
};
