<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideHasPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_has_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ride_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->timestamps();


            $table->foreign('ride_id')->references('id')->on('rides')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('payment_id')->references('id')->on('payments')
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
        Schema::dropIfExists('ride_has_payments');
    }
}
