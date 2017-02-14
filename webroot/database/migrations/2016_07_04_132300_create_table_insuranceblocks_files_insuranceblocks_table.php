<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInsuranceblocksFilesInsuranceblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insuranceblocks_files', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insuranceblock_id')->unsigned();
            $table->foreign('insuranceblock_id')->references('id')->on('insuranceblocks');

            $table->string('file');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('insuranceblocks_files');
    }
}
