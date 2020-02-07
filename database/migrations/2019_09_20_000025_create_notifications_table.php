<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->enum('state', ['created', 'viewed'])->nullable();
            $table->integer('toUser_id')->unsigned();
            $table->integer('fromUser_id')->unsigned();


            $table->timestamps();

            $table->foreign('toUser_id')->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDetete('cascade');

            $table->foreign('fromUser_id')->references('id')->on('users')
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
        Schema::dropIfExists('notifications');
    }
}
