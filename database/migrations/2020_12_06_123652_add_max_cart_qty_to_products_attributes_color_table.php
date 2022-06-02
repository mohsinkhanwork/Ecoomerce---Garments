<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaxCartQtyToProductsAttributesColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_attributes_color', function (Blueprint $table) {
            $table->integer('max_cart_qty')->default(0)->after('color_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_attributes_color', function (Blueprint $table) {
            //
        });
    }
}
