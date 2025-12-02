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
        Schema::table('orders', function (Blueprint $table){
            //user facing order numbers
            $table->string('order_number')->unique()->nullable()->after('id');

            //payment detail
            $table->string('payment_method')->nullable()->after('total_price');
            $table->string('payment_status')->default('unpaid')->after('payment_method');
            $table->timestamp('paid_at')->nullable()->after('payment_status');

            //shipping details
            $table->string('shipping_courier')->nullable()->after('paid_at');
            $table->string('shipping_tracking_number')->nullable()->after('shipping_courier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table){
            $table->dropColumn([
                'order_number',
                'payment_method',
                'payment_status',
                'paid_at',
                'shipping_courier',
                'shipping_tracking_number'
            ]);
        });
    }
};