<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsShowHomeToBlogEtcCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_etc_categories', function (Blueprint $table) {
            $table->tinyInteger('is_show_to_home')->default(0);
            $table->enum('home_layout', ['grid','slider'])->default('grid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_etc_categories', function (Blueprint $table) {
            $table->dropColumn("is_show_to_home");
            $table->dropColumn("home_layout");
        });
    }
}
