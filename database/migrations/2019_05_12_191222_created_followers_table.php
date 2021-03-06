<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            // $table->bigIncrements('id');
            //se crea una id compuesto entre el usuario y el usuario que es seguido
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('followed_id');

            $table->primary(['user_id', 'followed_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('followed_id')->references('id')->on('users');
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
        Schema::dropIfExists('followers');
    }
}
