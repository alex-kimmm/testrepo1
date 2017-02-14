<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancelandingsHomePageBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurancelandings_homepageblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insurancelanding_id')->unsigned();
            $table->foreign('insurancelanding_id')->references('id')->on('insurancelandings');

            $table->integer('homepageblock_id')->unsigned();
            $table->foreign('homepageblock_id')->references('id')->on('homepageblocks');

            $table->string('insurancelandings_homepageblock_type');
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
        Schema::drop('insurancelandings_homepageblocks');
    }
}
