<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldLinkOfBelongingPageCardsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('card_translations', function (Blueprint $table) {
            $table->dropColumn('link_of_page');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('card_translations', function (Blueprint $table) {
            $table->string('link_of_page')->after('status')->nullable();
        });
    }
}
