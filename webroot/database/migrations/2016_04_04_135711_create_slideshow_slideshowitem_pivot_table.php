<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideshowSlideshowitemPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slideshow_slideshowitems', function (Blueprint $table) {
            $table->integer('slideshow_id')->unsigned()->index();
            $table->foreign('slideshow_id')->references('id')->on('slideshows')->onDelete('cascade');
            $table->integer('slideshowitem_id')->unsigned()->index();
            $table->foreign('slideshowitem_id')->references('id')->on('slideshowitems')->onDelete('cascade');
            $table->string('slideshow_slideshowitem_type');
            $table->integer('position')->unsigned();
            $table->primary(['slideshow_id', 'slideshowitem_id']);
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
        Schema::drop('slideshow_slideshowitems');
    }
}
