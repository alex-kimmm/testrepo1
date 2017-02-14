<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageMobileForHeaderBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('headerblocks', function (Blueprint $table) {
            $table->string('image_mobile')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('headerblocks', function (Blueprint $table) {
            $table->dropColumn('image_mobile');
        });
    }
}
