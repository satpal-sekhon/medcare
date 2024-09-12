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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 75);
            $table->string('slug')->nullable();
            $table->string('address');
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('pincode', 6);
            $table->string('image')->nullable();
            $table->string('phone_number', 12)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('license_number', 100)->nullable();
            $table->string('license_path')->nullable();
            $table->enum('type', ['Pharmacy Store', 'Channel Partner', 'Other'])->default('Other');
            $table->enum('shop_type', ['Owned', 'Rented'])->nullable();
            $table->string('status', 25)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Adding indexes
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
