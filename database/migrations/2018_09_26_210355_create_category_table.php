<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('name');
            $table->text('description');
            $table->string('url');
            $table->string('weight');
            $table->string('length');
            $table->string('width');
            $table->string('height');
            $table->string('size_chart_image');
            $table->string('material_care_instruction');
            $table->tinyInteger('is_sizechart');
            $table->enum('filter_cat', ['shirts', 'hats']);
            $table->tinyInteger('status');
            $table->rememberToken();
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
        Schema::dropIfExists('categories');
    }
}
