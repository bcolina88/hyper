<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('fecha_inicial');
            $table->date('fecha_fin');
            $table->integer('tiempo');
            $table->integer('alcance');
            $table->integer('presupuesto');
            $table->boolean('active');
            $table->integer('palanca_id')->unsigned();
            $table->boolean('completada');


            $table->timestamps();

            $table->foreign('palanca_id')->references('id')->on('palancas')
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
        Schema::dropIfExists('experimentos');
    }
}
