<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderHasCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_has_coupons', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('discountCoupon_id')->unsigned();
            $table->integer('rider_id')->unsigned();
            $table->timestamps();

            $table->foreign('discountCoupon_id')->references('id')->on('discount_coupons')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('rider_id')->references('id')->on('riders')
            ->onUpdate('cascade')
            ->onDetete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_has_coupons');
    }
}
