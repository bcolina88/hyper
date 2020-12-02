<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->unsigned()->index();
            $table->integer('maestro_id')->unsigned()->index();
            $table->integer('agregar')->unsigned();
            $table->integer('editar')->unsigned();
            $table->integer('ver')->unsigned();
            $table->integer('inhabilitar')->unsigned();
            $table->integer('borrar')->unsigned();
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('roles')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('maestro_id')->references('id')->on('maestros')
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
        Schema::drop('permisos');
    }
}
