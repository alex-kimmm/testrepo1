<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddObjLinkPlaceholderToFailz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('failzs', function (Blueprint $table) {
            $table->string('obj_link_placeholder')->nullable()->default(null)->after('obj_link');
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
            $table->dropColumn('obj_link_placeholder');
        });
    }
}
