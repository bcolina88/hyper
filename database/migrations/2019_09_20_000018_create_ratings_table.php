<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            
            $table->increments('id');
            $table->enum('assessment1', [ 0 ,5 ,10, 15])->nullable();
            $table->enum('assessment2', [ 0 ,5 ,10, 15])->nullable();
            $table->enum('assessment3', [ 0 ,5 ,10, 15])->nullable();
            $table->string('assessmentDriver');
            $table->string('observations');
            $table->float('total', 8, 2);
            $table->enum('valuedBy', ['Rider','Driver'])->nullable();
           

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
        Schema::dropIfExists('ratings');
    }
}
