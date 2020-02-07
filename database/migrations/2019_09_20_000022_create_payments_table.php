<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount', 8, 2);
            $table->string('reference');
            $table->string('type');
            $table->text('comment');
            $table->integer('createdBy_id')->unsigned();
            $table->integer('updatedBy_id')->unsigned();
            $table->integer('bankAccount_id')->unsigned();
 

            $table->foreign('bankAccount_id')->references('id')->on('bank_accounts')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('createdBy_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('updatedBy_id')->references('id')->on('users')
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
        Schema::dropIfExists('payments');
    }
}
