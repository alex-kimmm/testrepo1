<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFailzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failzs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->boolean('inappropriate')->default(false);
            $table->boolean('is_giphy')->default(false);
            $table->tinyInteger('content_type')->default(\TypiCMS\Modules\Failzs\Models\Failz::$contentType['PICTURE']);
            $table->string('obj_link', 1023);
            $table->timestamps();
        });

        Schema::create('failz_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('failz_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
            $table->unique(['failz_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('failz_id')->references('id')->on('failzs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('failz_translations');
        Schema::drop('failzs');
    }
}
