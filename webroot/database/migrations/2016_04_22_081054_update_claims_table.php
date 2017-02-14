<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClaimsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign('claims_order_id_foreign');
            $table->dropColumn('order_id');

            $table->dropForeign('claims_product_id_foreign');
            $table->dropColumn('product_id');

            // new
            $table->integer('user_id')->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name')->after('user_id');
            $table->string('email')->after('name');
            $table->string('contact_number')->after('email');

            $table->integer('claim_gadget_id')->unsigned()->after('contact_number');
            $table->foreign('claim_gadget_id')->references('id')->on('claim_gadgets');

            $table->integer('quote_id')->after('claim_gadget_id');
            $table->string('was')->after('quote_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('claims', function (Blueprint $table) {
            $table->integer('order_id')->nullable()->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->integer('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            //
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('contact_number');
            $table->dropColumn('claim_gadget_id');
            $table->dropColumn('quote_id');
            $table->dropColumn('was');
        });
    }
}
