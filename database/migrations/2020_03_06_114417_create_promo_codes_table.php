<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('promo_code');
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_amount', 6, 2)->default(0);
            $table->tinyInteger('is_user_specific')->default(0);
            $table->integer('user_id')->nullable();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('promo_codes');
    }
}
