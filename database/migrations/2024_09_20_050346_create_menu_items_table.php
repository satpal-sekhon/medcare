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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('route_name')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_dropdown')->default(false);
            $table->string('menu_type')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('menu_items')->onDelete('cascade');
            $table->json('meta_tags')->nullable();
            $table->timestamps();

            // Add indexes
            $table->index('is_dropdown');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Drop foreign key first
        });

        Schema::dropIfExists('menu_items');
    }
};
