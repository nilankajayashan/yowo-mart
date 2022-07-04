<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_method');
            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->string('shipping_mobile');
            $table->string('shipping_country');
            $table->string('shipping_district');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');
            $table->string('shipping_address1');
            $table->string('shipping_address2')->nullable();
            $table->integer('shipping_price')->nullable();
            $table->text('shipping_note')->nullable();
            $table->string('payment_method');
            $table->string('payment_name');
            $table->string('payment_email');
            $table->string('payment_mobile');
            $table->string('payment_country');
            $table->string('payment_city');
            $table->string('payment_address');
            $table->string('payment_status')->default('failed');
            $table->text('cart');
            $table->string('order_status')->default('failed');
            $table->integer('total')->default(0);
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
