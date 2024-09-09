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
        Schema::create('lab_package_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('lab_package_id')->nullable();
            $table->string('name', 50);
            $table->string('email', 100);
            $table->string('phone_number', 12);
            $table->text('instructions')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->enum('payment_status', ['Pending', 'Completed'])->default('Pending');
            $table->enum('order_status', ['Pending', 'Canceled', 'Completed'])->default('Pending');
            $table->string('transaction_id')->nullable();
            $table->string('package_name', 100);
            $table->string('package_title', 100)->nullable();
            $table->string('package_image')->nullable();
            $table->decimal('package_amount', 8, 2)->default(0.00);
            $table->text('included_tests');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('lab_package_id')->references('id')->on('lab_packages')->onDelete('set null');

            // Adding indexes
            $table->index('user_id');
            $table->index('lab_package_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_package_orders');
    }
};
