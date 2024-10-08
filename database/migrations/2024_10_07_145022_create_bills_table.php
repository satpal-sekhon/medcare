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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billed_by')->nullable();
            $table->string('bill_from');
            $table->string('bill_from_address');
            $table->string('bill_from_contact');
            $table->unsignedBigInteger('bill_to')->nullable();
            $table->string('bill_to_name')->nullable();
            $table->string('bill_to_address');
            $table->string('bill_to_contact');
            $table->timestamps();

            $table->foreign('billed_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bill_to')->references('id')->on('users')->onDelete('cascade');

            // Adding indexes
            $table->index('billed_by');
            $table->index('bill_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
