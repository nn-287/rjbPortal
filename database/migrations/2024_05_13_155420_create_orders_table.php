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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('requested_items');
            $table->string('order_title');
            $table->string('driver_Lat');
            $table->string('driver_Long');
            $table->string('fees');
            $table->string('Additional_tips');
            $table->string('Ispaid');
            $table->string('Payment_Status');
            $table->string('order_volume');
            $table->string('PaymentMethod');
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
