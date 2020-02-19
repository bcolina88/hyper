<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {

            $table->increments('id');
            $table->double('x', 10, 6);
            $table->double('y', 10, 6);
            $table->string('name');
            $table->string('address');
            $table->string('percentagePriceIncrease');
            $table->string('durationIncrease');
            $table->string('increaseStartDate');
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
        Schema::dropIfExists('locations');
    }
}
