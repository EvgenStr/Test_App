<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwitterStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_storages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->string('hashtags');
            $table->string('media');
            $table->string('username');
            $table->string('user_img');
            $table->string('urls');
            $table->string('created_post');


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
        Schema::dropIfExists('twitter_storages');
    }
}
