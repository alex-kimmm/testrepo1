<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimGadgetsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('claim_gadgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('category', 50);
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->string('version', 50);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('claim_gadgets');
    }
}
