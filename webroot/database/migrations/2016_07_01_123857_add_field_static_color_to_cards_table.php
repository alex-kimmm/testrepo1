<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldStaticColorToCardsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('card_translations', function (Blueprint $table) {
            $table->text('title_background_color')->after('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('card_translations', function (Blueprint $table) {
            $table->dropColumn('title_background_color');
        });
    }
}
