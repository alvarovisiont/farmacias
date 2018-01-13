<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocktakingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocktakings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('providers_id')->unsigned();
            $table->integer('trademarks_id')->unsigned();
            $table->integer('groups_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->text('product');
            $table->string('component')->nullable()->default('');
            $table->integer('quantity');
            $table->double('price',15,2);
            $table->double('buying_price_provider',15,2);
            $table->date('buying_date');
            
            $table->integer('config_currencies_iva_id')->default(0);
            $table->integer('config_currencies_discount_id')->default(0);
            $table->date('date_of_expense');
            
            $table->foreign('providers_id')->references('id')->on('providers');
            $table->foreign('trademarks_id')->references('id')->on('trademarks');
            $table->foreign('groups_id')->references('id')->on('groups');
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('stocktakings');
    }
}
