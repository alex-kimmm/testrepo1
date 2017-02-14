<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusiclandingpagesHomepageblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('musiclandingpages_homepageblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('musiclandingpage_id')->unsigned();
            $table->foreign('musiclandingpage_id')->references('id')->on('musiclandingpages');

            $table->integer('homepageblock_id')->unsigned();
            $table->foreign('homepageblock_id')->references('id')->on('homepageblocks');

            $table->string('musiclandingpages_homepageblock_type');
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
        Schema::drop('musiclandingpages_homepageblocks');
    }
}
