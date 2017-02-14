<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddFailzSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failz_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        });

        $data = [
            ['key' => 'q', 'value' => 'fail'],
            ['key' => 'limit', 'value' => 10],
            ['key' => 'time', 'value' => '0 * * * * *'],
            ['key' => 'running', 'value' => 1]
        ];

        DB::table('failz_settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('failz_settings');
    }
}
