<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAltTextToColorwiseCategorySlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colorwise_category_slider', function (Blueprint $table) {
            $table->text('alt_text')->nullable()->after('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colorwise_category_slider', function (Blueprint $table) {
            $table->dropColumn("alt_text");
        });
    }
}
