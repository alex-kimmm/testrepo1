<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHomepageblocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('homepageblocks', function (Blueprint $table) {
            $table->string('block_background_image')->after('image')->nullable();
        });

        Schema::table('homepageblock_translations', function (Blueprint $table) {
            $table->string('position', 15)->after('status')->default('left'); // left|right
            $table->string('benefits_url')->after('position')->nullable();
            $table->string('subtitle')->after('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('homepageblocks', function (Blueprint $table) {
            $table->dropColumn('block_background_image');
        });

        Schema::table('homepageblock_translations', function (Blueprint $table) {
            $table->dropColumn('subtitle');
            $table->dropColumn('position');
            $table->dropColumn('benefits_url');
        });
    }
}
