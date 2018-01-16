<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user')->unique();
            $table->string('password')->nullable();
            $table->string('nombre_farmacia');
            $table->enum('nivel',[1,2]);
            $table->enum('rol',[1,2]);
            $table->mediumInteger('estado');
            $table->mediumInteger('municipio');
            $table->mediumInteger('parroquia');
            $table->smallInteger('status');
            $table->text('token_validation')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
