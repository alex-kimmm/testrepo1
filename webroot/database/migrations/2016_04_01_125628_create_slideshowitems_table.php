<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlideshowitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slideshowitems', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('page_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('slideshowitem_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('slideshowitem_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary');
            $table->text('body');
            $table->timestamps();
            $table->unique(['slideshowitem_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('slideshowitem_id')->references('id')->on('slideshowitems')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slideshowitem_translations');
        Schema::drop('slideshowitems');
    }
}
