<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionsToOrderProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_products', function($table)
        {
            $table->integer('quantity')->default(1)->after('product_id');
            $table->string('options', 1023)->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_products', function($table)
        {
            $table->dropColumn('quantity');
            $table->dropColumn('options');
        });
    }
}
