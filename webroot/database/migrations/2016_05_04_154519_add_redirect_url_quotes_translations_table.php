<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRedirectUrlQuotesTranslationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quote_translations', function (Blueprint $table) {
            $table->string('redirect_url')->nullable()->default(null)->after('uri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quote_translations', function (Blueprint $table) {
            $table->dropColumn('redirect_url');
        });
    }
}
