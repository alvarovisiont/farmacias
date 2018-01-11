<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buy_id')->unsigned();
            $table->integer('providers_id')->unsigned();
            $table->integer('stocktaking_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('quantity');
            $table->double('price',15,2);
            $table->double('total',15,2);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('providers_id')->references('id')->on('providers');
            $table->foreign('stocktaking_id')->references('id')->on('stocktakings');
            $table->foreign('buy_id')->references('id')->on('buys');
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
        Schema::dropIfExists('buy_details');
    }
}
