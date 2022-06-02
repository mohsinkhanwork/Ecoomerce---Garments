<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeaturedFieldsToYoutubeVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('youtube_videos', function (Blueprint $table) {
            $table->tinyInteger('is_featured')->default(0)->after('display_order');
            $table->tinyInteger('display_order_home')->default(1)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('youtube_videos', function (Blueprint $table) {
            $table->dropColumn("is_featured");
            $table->dropColumn("display_order_home");
        });
    }
}
