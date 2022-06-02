<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('color_code');
            $table->string('color_name');
            $table->string('filename');
            $table->tinyInteger('slider_scroll_1');
            $table->tinyInteger('slider_scroll_2');
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
        Schema::dropIfExists('colors_images');
    }
}
