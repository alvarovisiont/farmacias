<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyTemporalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_temporals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('providers_id')->unsigned();
            $table->integer('stocktaking_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('quantity');
            $table->double('price',15,2);
            $table->double('total',15,2);
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
        Schema::dropIfExists('buy_temporals');
    }
}
