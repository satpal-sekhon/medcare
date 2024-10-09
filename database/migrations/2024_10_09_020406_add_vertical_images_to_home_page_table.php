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
            for ($i = 1; $i <= 3; $i++) {
                $table->string("home_vertical_image_{$i}")->nullable()->after("home_horizontal_image_3_link");
                $table->string("home_vertical_image_{$i}_link")->nullable()->after("home_vertical_image_{$i}");
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page', function (Blueprint $table) {
            for ($i = 1; $i <= 3; $i++) {
                $table->dropColumn("home_vertical_image_{$i}");
                $table->dropColumn("home_vertical_image_{$i}_link");
            }
        });
    }
};
