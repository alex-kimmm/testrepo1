<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedFieldButtonTitleInsuranceblockTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('insuranceblock_translations', function (Blueprint $table) {
            $table->string('button_title')->after('summary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('insuranceblock_translations', function (Blueprint $table) {
            $table->dropColumn('button_title');
        });
    }
}
