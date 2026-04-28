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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('order_number', 32)->unique()->after('user_id');
            $table->string('shipping_address')->nullable()->after('guest_address');
            $table->string('payment_method')->default('manual')->after('status');
            $table->string('snap_token')->nullable()->after('payment_method');
            $table->string('midtrans_order_id')->nullable()->after('snap_token');
            $table->string('tracking_number')->nullable()->after('midtrans_order_id');
            $table->string('courier')->nullable()->after('tracking_number');
            $table->timestamp('paid_at')->nullable()->after('courier');
            $table->timestamp('shipped_at')->nullable()->after('paid_at');
            $table->timestamp('completed_at')->nullable()->after('shipped_at');

            // Guest columns changed to nullable
            $table->string('guest_name')->nullable()->change();
            $table->string('guest_email')->nullable()->change();
            $table->text('guest_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id', 'order_number', 'shipping_address', 'payment_method',
                'snap_token', 'midtrans_order_id', 'tracking_number', 'courier',
                'paid_at', 'shipped_at', 'completed_at'
            ]);

            $table->string('guest_name')->nullable(false)->change();
            $table->string('guest_email')->nullable(false)->change();
            $table->text('guest_address')->nullable(false)->change();
        });
    }
};
