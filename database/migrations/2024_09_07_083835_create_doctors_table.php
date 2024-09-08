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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_type_id');
            $table->string('name', 50);
            $table->string('email', 100);
            $table->string('phone_number', 12);
            $table->string('qualification', 100);
            $table->string('image')->nullable();
            $table->decimal('experience', 3, 1)->nullable(); 
            $table->decimal('fee', 8, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('doctor_type_id')->references('id')->on('doctor_types')->onDelete('set null');

            // Adding index on primary_category_id
            $table->index('doctor_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
