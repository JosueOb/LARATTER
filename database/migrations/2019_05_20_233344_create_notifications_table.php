<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();//genrado por laravel
            $table->string('type');
            $table->morphs('notifiable');//relacion con un objeto notifiable
            $table->text('data');//contien un json que sera toda la serializacion de todo los datos pra ala notificación 
            $table->timestamp('read_at')->nullable();// si la notificación es leida o no
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
        Schema::dropIfExists('notifications');
    }
}
