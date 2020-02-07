<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->double('x', 10, 6);
            $table->double('y', 10, 6);
            $table->string('carType');
            $table->integer('rider_id')->unsigned();

            $table->timestamps();

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
        Schema::dropIfExists('ride_requests');
    }
}
