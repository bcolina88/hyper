<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('color');
            $table->boolean('airConditioning');
            $table->enum('confort', ['basic', 'standard', 'luxury'])->nullable();

            $table->enum('upholstery', ['leather','foamized','cloth','microfiber'])->nullable();

            $table->enum('paintState', [ 'good' ,'regular' ,'basic'])->nullable();

            $table->integer('model_id')->unsigned();
            $table->integer('typeCar_id')->unsigned();

            $table->string('year');
            $table->string('registrationDate');
            $table->string('lastCheckDate');
            $table->boolean('armored');
            $table->string('status');

            $table->enum('armoredLevel', [ 1 ,2 ,3])->nullable();

            $table->string('plateNumber');
            $table->string('circulationCertificate');
            $table->string('propertyTitle');
            $table->string('serialCar');
            $table->boolean('lateralMirrors');
            $table->boolean('rearViewMirror');
            $table->boolean('frontLights');
            $table->boolean('taillights');
            $table->boolean('blinkingLights');

            $table->enum('rubbersState', ['good', 'regular', 'wornOut'])->nullable();

            $table->string('vehicleStatus');
            $table->string('travelOtherStates');
            $table->string('photos')->nullable();


            $table->foreign('model_id')->references('id')->on('models')
            ->onUpdate('cascade')
            ->onDetete('cascade');


            $table->foreign('typeCar_id')->references('id')->on('type_cars')
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
        Schema::dropIfExists('cars');
    }
}
