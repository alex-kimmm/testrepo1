<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGiphyIdToFailzTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('failzs', function (Blueprint $table) {
            $table->string('giphy_id')->nullable()->default(null)->after('is_giphy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('failzs', function (Blueprint $table) {
            $table->dropColumn('giphy_id');
        });
    }
}
