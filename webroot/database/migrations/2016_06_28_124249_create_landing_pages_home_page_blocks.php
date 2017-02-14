<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPagesHomePageBlocks extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('landingpages_homepageblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('landingpage_id')->unsigned();
            $table->foreign('landingpage_id')->references('id')->on('landingpages');

            $table->integer('homepageblock_id')->unsigned();
            $table->foreign('homepageblock_id')->references('id')->on('homepageblocks');

            $table->string('landingpages_homepageblock_type');
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
        Schema::drop('landingpages_homepageblocks');
    }
}
