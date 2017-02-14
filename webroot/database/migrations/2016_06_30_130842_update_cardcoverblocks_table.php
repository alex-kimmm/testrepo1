<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCardcoverblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('cardcoverblocks', function (Blueprint $table) {
            //
        });

        Schema::table('cardcoverblock_translations', function (Blueprint $table) {
            $table->text('card_title')->after('title')->nullable();
            $table->string('button_title')->after('card_title')->nullable();
            $table->string('button_link')->after('button_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('cardcoverblocks', function (Blueprint $table) {
            //
        });

        Schema::table('cardcoverblock_translations', function (Blueprint $table) {
            $table->dropColumn('card_title');
            $table->dropColumn('button_title');
            $table->dropColumn('button_link');
        });
    }
}
