<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('payment_charge_id');
            $table->string('payment_status');
            $table->string('description');
            $table->string('currency');
            $table->decimal('shipping_rates', 10, 2);
            $table->decimal('sales_tax_rate', 10, 2);
            $table->decimal('cart_amount', 10, 2);
            $table->double('total_amount');
            $table->double('paid_amount');
            $table->string('brand');
            $table->string('country');
            $table->integer('order_status')->default('1');
            $table->tinyInteger('archived')->default(0);
            $table->string('session_id');
            $table->string('shippo_provider');
            $table->string('shippo_object_id');
            $table->tinyInteger('shippo_synced')->default(0);
            $table->string('shippo_synced_id');
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
}
