<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->text('method')->nullable();
            $table->text('name')->nullable();
            $table->text('rif')->nullable();
            $table->text('phone')->nullable();
            $table->boolean('active');
            $table->integer('bank_id')->unsigned()->nullable();
 
            $table->foreign('bank_id')->references('id')->on('banks')
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
        Schema::dropIfExists('payment_methods');
    }
}
