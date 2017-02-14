<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancepagesInsuranceblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insurancepages_insuranceblocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('insurancepage_id')->unsigned();
            $table->foreign('insurancepage_id')->references('id')->on('insurancepages');

            $table->integer('insuranceblock_id')->unsigned();
            $table->foreign('insuranceblock_id')->references('id')->on('insuranceblocks');

            $table->string('insurancepages_insuranceblock_type');
            $table->integer('position')->unsigned();

            $table->timestamps();
        });

        // update blocks with position left
        $updateFieldPosition = "UPDATE `typicms_insuranceblock_translations` SET `position` = 'left' WHERE `position` = 'l'";
        DB::statement($updateFieldPosition);

        // update blocks with position right
        $updateFieldPosition = "UPDATE `typicms_insuranceblock_translations` SET `position` = 'right' WHERE `position` = 'r'";
        DB::statement($updateFieldPosition);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('insurancepages_insuranceblocks');
    }
}
