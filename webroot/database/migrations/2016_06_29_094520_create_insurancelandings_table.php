<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInsurancelandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurancelandings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('header_block_id')->unsigned();
            $table->foreign('header_block_id')->references('id')->on('headerblocks');
            $table->timestamps();
        });

        Schema::create('insurancelanding_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('insurancelanding_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['insurancelanding_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('insurancelanding_id')->references('id')->on('insurancelandings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('insurancelanding_translations');
        Schema::drop('insurancelandings');
    }
}
