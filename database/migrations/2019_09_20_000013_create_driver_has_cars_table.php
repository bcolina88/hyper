<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverHasCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_has_cars', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('car_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('driver_id')->references('id')->on('drivers')
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
        Schema::dropIfExists('driver_has_cars');
    }
}
