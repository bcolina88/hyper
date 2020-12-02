<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palancas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('estrategia');
            $table->boolean('active');
            $table->boolean('completada');
            $table->integer('num_exp_valid');
            
            $table->integer('objetivo_id')->unsigned();
            $table->timestamps();

            $table->foreign('objetivo_id')->references('id')->on('objetivos')
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
        Schema::dropIfExists('palancas');
    }
}
