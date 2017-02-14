<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesCards extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('landingpages_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('landingpage_id')->unsigned();
            $table->foreign('landingpage_id')->references('id')->on('landingpages');

            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');

            $table->string('landingpages_card_type');
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
        Schema::drop('landingpages_cards');
    }
}
