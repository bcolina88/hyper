<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ride_id')->unsigned();
            $table->integer('location_id')->unsigned();
            $table->timestamps();


            $table->foreign('ride_id')->references('id')->on('rides')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('location_id')->references('id')->on('locations')
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
        Schema::dropIfExists('rider_addresses');
    }
}
