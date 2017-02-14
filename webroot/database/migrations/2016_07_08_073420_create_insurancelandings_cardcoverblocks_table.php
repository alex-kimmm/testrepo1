<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancelandingsCardcoverblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insurancelandings_cardcoverblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insurancelanding_id')->unsigned();
            $table->foreign('insurancelanding_id')->references('id')->on('insurancelandings');

            $table->integer('cardcoverblock_id')->unsigned();
            $table->foreign('cardcoverblock_id')->references('id')->on('cardcoverblocks');

            $table->string('insurancelandings_cardcoverblock_type');
            $table->integer('position')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('insurancelandings_cardcoverblocks');
    }
}
