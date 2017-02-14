<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagefailzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagefailzs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('header_block_id')->unsigned();
            $table->foreign('header_block_id')->references('id')->on('headerblocks');
            $table->timestamps();
        });

        Schema::create('pagefailz_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('pagefailz_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['pagefailz_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('pagefailz_id')->references('id')->on('pagefailzs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pagefailz_translations');
        Schema::drop('pagefailzs');
    }
}
