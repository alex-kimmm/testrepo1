<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMusiclandingpagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('musiclandingpages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('header_block_id')->unsigned();
            $table->foreign('header_block_id')->references('id')->on('headerblocks');

            $table->timestamps();
        });

        Schema::create('musiclandingpage_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('musiclandingpage_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['musiclandingpage_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('musiclandingpage_id')->references('id')->on('musiclandingpages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('musiclandingpage_translations');
        Schema::drop('musiclandingpages');
    }
}
