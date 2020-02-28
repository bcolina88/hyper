<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->double('xOrig', 10, 6)->nullable();
            $table->double('yOrig', 10, 6)->nullable();
            $table->double('xDest', 10, 6)->nullable();
            $table->double('yDest', 10, 6)->nullable();
            $table->double('totalPrice', 8, 2)->nullable();
            $table->double('pendingPayment', 8, 2);
            $table->double('totalPaid', 8, 2);
            $table->string('pickupTime')->nullable();
            $table->string('dropoffTime')->nullable();
            $table->enum('pets', ['dog','cat','other'])->nullable();
            $table->integer('duration')->nullable();

      
            $table->enum('luggage', ['small','medium','large'])->nullable();
            $table->string('pickupAddr')->nullable();
            $table->string('destAddr')->nullable();
            $table->text('note')->nullable();
            $table->integer('travellers')->default(1);

            $table->enum('status', ['InProcess', 'Completed','Cancelled','Valued Rider','Valued Driver'])->nullable();
            $table->integer('payment')->default(0);

            $table->integer('distance')->nullable();

            $table->integer('rider_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->integer('car_id')->unsigned();

            $table->timestamps();



            $table->foreign('rider_id')->references('id')->on('riders')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('driver_id')->references('id')->on('drivers')
            ->onUpdate('cascade')
            ->onDetete('cascade');

            $table->foreign('car_id')->references('id')->on('cars')
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
        Schema::dropIfExists('rides');
    }
}
