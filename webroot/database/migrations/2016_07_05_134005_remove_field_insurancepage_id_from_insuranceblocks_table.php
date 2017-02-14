<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldInsurancepageIdFromInsuranceblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('insuranceblocks', function (Blueprint $table) {
            $table->dropForeign('insuranceblocks_insurancepage_id_foreign');
            $table->dropColumn('insurancepage_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('insuranceblocks', function (Blueprint $table) {
            $table->integer('insurancepage_id')->unsigned();
            $table->foreign('insurancepage_id')->references('id')->on('insurancepages');
        });
    }
}
