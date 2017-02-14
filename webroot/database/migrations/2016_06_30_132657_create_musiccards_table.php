<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMusiccardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musiccards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('musiccard_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('musiccard_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->string('song_name')->nullable();
            $table->timestamps();
            $table->unique(['musiccard_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('musiccard_id')->references('id')->on('musiccards')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('musiccard_translations');
        Schema::drop('musiccards');
    }
}
