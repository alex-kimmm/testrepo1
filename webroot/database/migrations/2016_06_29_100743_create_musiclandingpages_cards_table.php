<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusiclandingpagesCardsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('musiclandingpages_cards', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('musiclandingpage_id')->unsigned();
            $table->foreign('musiclandingpage_id')->references('id')->on('musiclandingpages');

            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');

            $table->string('musiclandingpages_card_type');
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
        Schema::drop('musiclandingpages_cards');
    }
}
