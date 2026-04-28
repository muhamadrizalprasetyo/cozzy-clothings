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
        // Add balance to users table
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 15, 2)->default(1000000)->after('address');
        });

        // Add payment fields to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->after('status');
            $table->string('payment_method')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method']);
        });
    }
};
