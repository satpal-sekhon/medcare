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
        Schema::create('lab_package_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_package_id');
            $table->unsignedBigInteger('lab_test_id');
            $table->timestamps();

            $table->foreign('lab_package_id')->references('id')->on('lab_packages')->onDelete('cascade');
            $table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade');

            // Adding indexes
            $table->index('lab_package_id');
            $table->index('lab_test_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_package_tests');
    }
};
