<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaceofzzlandingsCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faceofzzlandings_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('faceofzzlanding_id')->unsigned();
            $table->foreign('faceofzzlanding_id')->references('id')->on('faceofzzlandings');

            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');

            $table->string('faceofzzlandings_card_type');
            $table->integer('position')->unsigned();

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
        Schema::drop('faceofzzlandings_cards');
    }
}
