<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('products_id');
            $table->double('price',15,2);
            $table->integer('config_currencies_iva')->default(0);
            $table->integer('config_currencies_discount')->default(0);
            $table->integer('quantity');
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
        Schema::dropIfExists('temp_sales');
    }
}
