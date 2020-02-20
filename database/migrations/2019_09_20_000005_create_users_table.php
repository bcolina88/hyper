<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('lastName');
            $table->string('phone');
            $table->string('fullName');
            $table->string('dni')->unique();
            $table->string('birthDate');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_picture');
            $table->boolean('active');
            $table->rememberToken();
            $table->integer('role_id')->unsigned();

            $table->timestamps();



            $table->foreign('role_id')->references('id')->on('roles')
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
        Schema::dropIfExists('users');
    }
}
