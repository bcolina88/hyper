<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accountNumber');
            $table->string('type');
            $table->string('currency');
            $table->string('comment');
            $table->float('beginningBalance', 20, 2);
            $table->float('currentBalance', 20, 2);
            $table->integer('owner_id')->unsigned();
            $table->integer('bank_id')->unsigned();
            $table->timestamps();



            $table->foreign('owner_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDetete('cascade');
            
            $table->foreign('bank_id')->references('id')->on('banks')
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
        Schema::dropIfExists('bank_accounts');
    }
}
