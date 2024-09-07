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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 25);
            $table->string('phone', 12);
            $table->string('address_line1', 150);
            $table->string('address_line2', 150)->nullable();
            $table->string('city', 75);
            $table->string('state', 75);
            $table->string('pincode', 6);
            $table->string('address_type', 25)->nullable();
            $table->string('company_name', 75)->nullable();
            $table->string('instructions', 255)->nullable();
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Adding index on user_id
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
