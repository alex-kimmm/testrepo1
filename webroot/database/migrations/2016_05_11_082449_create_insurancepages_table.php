<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInsurancepagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insurancepages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->integer('step')->default(1);

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unique(['category_id', 'step']);

            $table->integer('gradient_id')->nullable()->unsigned();
            $table->foreign('gradient_id')->references('id')->on('gradients');

            $table->timestamps();
        });

        Schema::create('insurancepage_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('insurancepage_id')->unsigned();
            $table->string('locale');
            $table->boolean('status')->default(0);
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('menu_title')->nullable();
            $table->string('slug')->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();

            $table->timestamps();

            $table->unique(['insurancepage_id', 'locale']);
            $table->unique(['locale', 'slug']);
            $table->foreign('insurancepage_id')->references('id')->on('insurancepages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('insurancepage_translations');
        Schema::drop('insurancepages');
    }
}
