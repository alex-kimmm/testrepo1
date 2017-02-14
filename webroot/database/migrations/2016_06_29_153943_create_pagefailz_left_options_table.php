<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagefailzLeftOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagefailz_left_options', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('position')->unsigned();

            $table->integer('pagefailzs_id')->unsigned();
            $table->foreign('pagefailzs_id')->references('id')->on('pagefailzs');

            $table->integer('failz_id')->unsigned();
            $table->foreign('failz_id')->references('id')->on('failzs');

            $table->string('pagefailz_left_option_type');

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
        Schema::drop('pagefailz_left_options');
    }
}
