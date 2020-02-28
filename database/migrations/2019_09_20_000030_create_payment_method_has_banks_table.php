<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodHasBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method_has_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bankAccount_id')->unsigned();
            $table->integer('paymentMethod_id')->unsigned();
            $table->timestamps();


            $table->foreign('bankAccount_id')->references('id')->on('bank_accounts')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('paymentMethod_id')->references('id')->on('payment_methods')
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
        Schema::dropIfExists('payment_method_has_banks');
    }
}
