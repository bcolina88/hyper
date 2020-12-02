<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('fecha_inicial');
            $table->date('fecha_fin');
            $table->integer('valor_inicial');
            $table->integer('valor_objetivo');
            $table->boolean('active');
            $table->boolean('completada');
            
            $table->integer('proyecto_id')->unsigned();
            $table->timestamps();

            $table->foreign('proyecto_id')->references('id')->on('proyects')
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
        Schema::dropIfExists('objetivos');
    }
}
