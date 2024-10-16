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
        Schema::table('quick_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('pharmacy_user_id')->nullable()->after('assigned_to');

            $table->foreign('pharmacy_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_orders', function (Blueprint $table) {
            $table->dropColumn('pharmacy_user_id');
        });
    }
};
