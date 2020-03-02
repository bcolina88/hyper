<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideHasRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_has_ratings', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('ride_id')->unsigned();
            $table->integer('rating_id')->unsigned();
            $table->timestamps();

            $table->foreign('ride_id')->references('id')->on('rides')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('rating_id')->references('id')->on('ratings')
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
        Schema::dropIfExists('ride_has_ratings');
    }
}
