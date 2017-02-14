<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLogoFieldsToInsuranceblockTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insuranceblocks', function (Blueprint $table) {
            $table->string('first_logo')->nullable()->after('order');
            $table->string('second_logo')->nullable()->after('first_logo');
            $table->string('third_logo')->nullable()->after('second_logo');
        });

        Schema::table('insuranceblock_translations', function (Blueprint $table) {
            $table->text('first_logo_text')->nullable()->after('summary');
            $table->text('first_logo_description')->nullable()->after('first_logo_text');

            $table->text('second_logo_text')->nullable()->after('first_logo_description');
            $table->text('second_logo_description')->nullable()->after('second_logo_text');

            $table->text('third_logo_text')->nullable()->after('second_logo_description');
            $table->text('third_logo_description')->nullable()->after('third_logo_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insuranceblocks', function (Blueprint $table) {
            $table->dropColumn('first_logo');
            $table->dropColumn('second_logo');
            $table->dropColumn('third_logo');
        });

        Schema::table('insuranceblock_translations', function (Blueprint $table) {
            $table->dropColumn('first_logo_text');
            $table->dropColumn('first_logo_description');

            $table->dropColumn('second_logo_text');
            $table->dropColumn('second_logo_description');

            $table->dropColumn('third_logo_text');
            $table->dropColumn('third_logo_description');
        });
    }
}
