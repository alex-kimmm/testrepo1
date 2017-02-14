<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MusiclandingpagesCardcoverblocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musiclandingpages_cardcoverblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('musiclandingpage_id')->unsigned();
            $table->foreign('musiclandingpage_id')->references('id')->on('musiclandingpages');

            $table->integer('cardcoverblock_id')->unsigned();
            $table->foreign('cardcoverblock_id')->references('id')->on('cardcoverblocks');

            $table->string('musiclandingpages_cardcoverblock_type');
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
        Schema::drop('musiclandingpages_cardcoverblocks');
    }
}
