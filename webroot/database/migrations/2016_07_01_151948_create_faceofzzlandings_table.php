<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFaceofzzlandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faceofzzlandings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('header_block_id')->unsigned();
            $table->foreign('header_block_id')->references('id')->on('headerblocks');
            $table->timestamps();
        });

        Schema::create('faceofzzlanding_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('faceofzzlanding_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['faceofzzlanding_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('faceofzzlanding_id')->references('id')->on('faceofzzlandings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faceofzzlanding_translations');
        Schema::drop('faceofzzlandings');
    }
}
