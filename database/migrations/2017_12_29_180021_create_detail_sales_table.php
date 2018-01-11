<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_id')->unsigned();
            $table->integer('products_id')->unsigned();
            $table->double('price',15,2);
            $table->integer('config_currencies_iva')->default(0);
            $table->integer('config_currencies_discount')->default(0);
            $table->integer('quantity');
            $table->double('total',15,2);
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->foreign('products_id')->references('id')->on('stocktakings');
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
        Schema::dropIfExists('detail_sales');
    }
}
