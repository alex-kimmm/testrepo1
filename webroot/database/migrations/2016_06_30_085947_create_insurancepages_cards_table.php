<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancepagesCardsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insurancepages_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insurancepage_id')->unsigned();
            $table->foreign('insurancepage_id')->references('id')->on('insurancepages');

            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');

            $table->string('insurancepages_card_type');
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
        Schema::drop('insurancepages_cards');
    }
}
