<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('image')->nullable();

            $table->integer('gradient_id')->nullable()->unsigned();
            $table->foreign('gradient_id')->references('id')->on('gradients');

            $table->timestamps();
        });

        Schema::create('card_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('card_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('link_of_page');
            $table->string('tag');
            $table->string('title');
            $table->string('redirect_link');
            $table->boolean('open_link_new_tab')->default(0);
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
            $table->unique(['card_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('card_translations');
        Schema::drop('cards');
    }
}
