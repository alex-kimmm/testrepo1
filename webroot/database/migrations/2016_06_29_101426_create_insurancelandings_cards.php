<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancelandingsCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurancelandings_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insurancelanding_id')->unsigned();
            $table->foreign('insurancelanding_id')->references('id')->on('insurancelandings');

            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');

            $table->string('insurancelandings_card_type');
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
        Schema::drop('insurancelandings_cards');
    }
}
