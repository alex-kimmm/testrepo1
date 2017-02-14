<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLandingpagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('landingpages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('header_block_id')->unsigned();
            $table->foreign('header_block_id')->references('id')->on('headerblocks');

            $table->timestamps();
        });

        Schema::create('landingpage_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('landingpage_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['landingpage_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('landingpage_id')->references('id')->on('landingpages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('landingpage_translations');
        Schema::drop('landingpages');
    }
}
