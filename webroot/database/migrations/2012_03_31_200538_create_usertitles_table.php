<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsertitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertitles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('usertitle_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('usertitle_id')->unsigned();
            $table->string('locale');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->unique(['usertitle_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('usertitle_id')->references('id')->on('usertitles')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usertitle_translations');
        Schema::drop('usertitles');
    }
}
