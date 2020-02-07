<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->double('x', 10, 6);
            $table->double('y', 10, 6);
            $table->double('kmWorked', 10, 2);
            $table->boolean('availableTravelOtherStates');
            $table->boolean('nightTripsAvailable');
            $table->boolean('active');
            $table->boolean('status');
            $table->enum('accountStatus', ['locked', 'active', 'revision'])->nullable();
            $table->text('residenceAddress');
            $table->text('profilePicture');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDetete('cascade');


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
        Schema::dropIfExists('drivers');
    }
}
