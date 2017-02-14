<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHeaderblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('headerblocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->integer('gradient_id')->nullable()->unsigned();
            $table->foreign('gradient_id')->references('id')->on('gradients');

            $table->timestamps();
        });

        Schema::create('headerblock_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('headerblock_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title')->nullable();

            $table->boolean('auto_play')->default(false);

            $table->string('quote_text')->nullable();
            $table->string('quote_subtext')->nullable();
            $table->string('position', 15)->default('left'); // left|right

            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();

            $table->timestamps();

            $table->unique(['headerblock_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('headerblock_id')->references('id')->on('headerblocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('headerblock_translations');
        Schema::drop('headerblocks');
    }
}