<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->double('x', 10, 6);
            $table->double('y', 10, 6);
            $table->float('value', 20, 2);
            $table->integer('distance')->nullable();
            $table->string('adrees')->nullable();
            $table->boolean('active');
            $table->integer('currency_id')->unsigned();
            $table->integer('createdBy_id')->unsigned();
            $table->integer('updatedBy_id')->unsigned();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('currencys')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('createdBy_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('updatedBy_id')->references('id')->on('users')
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
        Schema::dropIfExists('travel_rates');
    }
}
