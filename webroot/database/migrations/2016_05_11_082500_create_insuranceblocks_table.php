<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInsuranceblocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insuranceblocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('insurancepage_id')->unsigned();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('insurancepage_id')->references('id')->on('insurancepages')->onDelete('cascade');
        });

        Schema::create('insuranceblock_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('insuranceblock_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);

            $table->boolean('in_menu')->default(1);
            $table->string('menu_title')->nullable();

            $table->boolean('title_hidden')->default(0);
            $table->string('title');
            $table->string('heading')->nullable();

            $table->string('second_heading')->nullable();
            $table->string('decor_heading')->nullable();

            $table->string('position', 15)->default('l'); // l|r

            $table->string('slug')->nullable();
            $table->text('summary')->nullable();

            $table->timestamps();
            $table->unique(['insuranceblock_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('insuranceblock_id')->references('id')->on('insuranceblocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('insuranceblock_translations');
        Schema::drop('insuranceblocks');
    }
}
