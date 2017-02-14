<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaceofzzlandingsHomePageBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faceofzzlandings_homepageblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('faceofzzlanding_id')->unsigned();
            $table->foreign('faceofzzlanding_id')->references('id')->on('faceofzzlandings');

            $table->integer('homepageblock_id')->unsigned();
            $table->foreign('homepageblock_id')->references('id')->on('homepageblocks');

            $table->string('faceofzzlandings_homepageblock_type');
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
        Schema::drop('faceofzzlandings_homepageblocks');
    }
}
